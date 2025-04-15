<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class InvoiceGenerate extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoice.create');
    }

    public function show($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            return view('invoice.show', compact('invoice'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invoice not found ' . $e->getMessage() . ' ' . $e->getLine());
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $document = Invoice::create([
            'title' => $data['title'] ?? null,
            'subtitle' => $data['subtitle'] ?? null,
            'document_number' => $data['document_number'] ?? null,
            'revision_table' => json_encode([
                'created_by' => $data['created_by'] ?? [],
                'created_by_date' => $data['created_by_date'] ?? [],
                'reviewed_by' => $data['reviewed_by'] ?? [],
                'reviewed_by_date' => $data['reviewed_by_date'] ?? [],
                'approved_by' => $data['approved_by'] ?? [],
                'approved_by_date' => $data['approved_by_date'] ?? [],
                'reason_of_revision' => $data['reason_of_revision'] ?? []
            ]),
            'toc_items' => json_encode($data['toc_items'] ?? []),
            'sections' => json_encode([
                'section_titles' => $data['section_titles'] ?? [],
                'subtitle_titles' => $data['subtitle_titles'] ?? [],
                'subtitle_contents' => $data['subtitle_contents'] ?? [],
                'subtitle_images' => $data['subtitle_images'] ?? []
            ])
        ]);
        // -----------------------------------------------
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText($data['title'] ?? 'Title', ['size' => 16, 'bold' => true], ['alignment' => 'center']);
        $section->addTextBreak(1);
        if (!empty($data['subtitle'])) {
            $section->addText($data['subtitle'] ?? 'Subtitle', ['size' => 14, 'italic' => true], ['alignment' => 'center']);
            $section->addTextBreak(1);
        }
        $section->addText("Document Number: " . $data['document_number'], ['bold' => true]);
        $section->addText("Revision Table", ['size' => 14, 'bold' => true]);
        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 50]);
        $table->addRow();
        $headers = ['Revision', 'Created By', 'Created Date', 'Reviewed By', 'Reviewed Date', 'Approved By', 'Approved Date', 'Reason of Revision'];
        foreach ($headers as $header) {
            $table->addCell(1500)->addText($header, ['bold' => true]);
        }
        if (!empty($data['created_by'])) {
            foreach ($data['created_by'] as $index => $createdBy) {
                $table->addRow();
                $table->addCell(1500)->addText($index + 1); // Revision number
                $table->addCell(1500)->addText($createdBy);
                $table->addCell(1500)->addText($data['created_by_date'][$index] ?? '');
                $table->addCell(1500)->addText($data['reviewed_by'][$index] ?? '');
                $table->addCell(1500)->addText($data['reviewed_by_date'][$index] ?? '');
                $table->addCell(1500)->addText($data['approved_by'][$index] ?? '');
                $table->addCell(1500)->addText($data['approved_by_date'][$index] ?? '');
                $table->addCell(1500)->addText($data['reason_of_revision'][$index] ?? '');
            }
        }
        $phpWord->addTitleStyle(1, ['bold' => true, 'size' => 18], ['alignment' => 'center']);
        $phpWord->addTitleStyle(2, ['bold' => true, 'size' => 16]);
        $phpWord->addTitleStyle(3, ['bold' => true, 'size' => 14, 'italic' => true]);
        $tocSection = $phpWord->addSection();
        $tocSection->addTitle("Table of Contents", 1);
        $tocBookmarks = [];
        if (!empty(($data['toc_items']))) {
            foreach ($data['toc_items'] as $index => $tocItem) {
                $bookmarkName = 'toc_' . $index;
                $tocBookmarks[] = $bookmarkName;
                $tocSection->addTextRun()->addLink('#' . $bookmarkName, $tocItem);
                $tocSection->addText($data['section_titles'][$index] ?? 'Section Title', ['bold' => true]);
                if (isset($data['subtitle_titles'][$index + 1])) {
                    foreach ($data['subtitle_titles'][$index + 1] as $subIndex => $subtitle) {
                        $bookmarkNameSub = $bookmarkName . '_sub' . $subIndex;
                        $tocBookmarks[] = $bookmarkNameSub;
                        $tocSection->addTextRun()->addLink('#' . $bookmarkNameSub, $subtitle);
                    }
                }
            }
            $contentSection = $phpWord->addSection();
            foreach ($data['toc_items'] as $index => $tocItem) {
                $bookmarkName = 'toc_' . $index;
                $contentSection->addTextRun()->addBookmark($bookmarkName);
                $contentSection->addTitle($data['section_titles'][$index] ?? 'Section Title', 2);
                if (isset($data['subtitle_titles'][$index + 1])) {
                    foreach ($data['subtitle_titles'][$index + 1] as $subIndex => $subtitle) {
                        $bookmarkNameSub = $bookmarkName . '_sub' . $subIndex;
                        $contentSection->addTextRun()->addBookmark($bookmarkNameSub);
                        $contentSection->addTitle($subtitle, 3);
                        if (isset($data['subtitle_contents'][$index + 1][$subIndex])) {
                            $content = $data['subtitle_contents'][$index + 1][$subIndex];
                            $contentSection->addText($content);
                        } else {
                            $contentSection->addText("No content provided.");
                        }
                        if (isset($data['subtitle_images'][$index + 1][$subIndex])) {
                            $content = $data['subtitle_images'][$index + 1][$subIndex];
                            $contentSection->addText($content);
                        } else {
                            $contentSection->addText("No Image provided.");
                        }
                    }
                }
                $contentSection->addPageBreak();
            }
        }
        $fileName = $data['title'] . '_' . $data['document_number'] . '_file.docx';
        $tempFile = storage_path('app/' . $fileName);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }

    public function edit($id)
    {
        try {
            $invoice = Invoice::findOrFail($id);
            return view('invoice.edit', compact('invoice'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invoice not found ' . $e->getMessage() . ' ' . $e->getLine());
        }
    }

    public function update($id)
    {
        dd($id);
    }

    public function destroy($id)
    {
        try {
            $invoices = Invoice::findOrFail($id);
            $invoices->delete();
            return redirect()->back()->with('success', 'Invoice deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invoice cannot delete. ' . $e->getMessage());
        }
    }

    public function duplicateInvoice(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return redirect()->back()->with('error', 'Invoice not found');
        }
        try {
            $newInvoice = Invoice::create([
                'title' => $invoice->title,
                'subtitle' => $invoice->subtitle,
                'document_number' => $invoice->document_number,
                'revision_table' => $invoice->revision_table,
                'toc_items' => $invoice->toc_items,
                'sections' => $invoice->sections,
            ]);
            return redirect()->back()->with('success', 'Invoice duplicated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'There was an error duplicating the invoice' . $e->getMessage());
        }
    }

    public function downloadInvoice($id)
    {
        $data = Invoice::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Invoice not found');
        }

        $revisionTable = json_decode($data->revision_table, true);
        $tocItems = json_decode($data->toc_items, true);
        $sections = json_decode($data->sections, true);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText($data->title, ['size' => 16, 'bold' => true], ['alignment' => 'center']);
        $section->addTextBreak(1);

        if (!empty($data->subtitle)) {
            $section->addText($data->subtitle, ['size' => 14, 'italic' => true], ['alignment' => 'center']);
            $section->addTextBreak(1);
        }

        $section->addText("Document Number: " . $data->document_number, ['bold' => true]);
        $section->addText("Revision Table", ['size' => 14, 'bold' => true]);

        // Create table
        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 50]);
        $table->addRow();
        $headers = ['Revision', 'Created By', 'Created Date', 'Reviewed By', 'Reviewed Date', 'Approved By', 'Approved Date', 'Reason of Revision'];
        foreach ($headers as $header) {
            $table->addCell(1500)->addText($header, ['bold' => true]);
        }

        // Populate revision table
        if (!empty($revisionTable)) {
            foreach ($revisionTable['created_by'] as $index => $createdBy) {
                $table->addRow();
                $table->addCell(1500)->addText($index + 1); // Revision number
                $table->addCell(1500)->addText($createdBy);
                $table->addCell(1500)->addText($revisionTable['created_by_date'][$index] ?? '');
                $table->addCell(1500)->addText($revisionTable['reviewed_by'][$index] ?? '');
                $table->addCell(1500)->addText($revisionTable['reviewed_by_date'][$index] ?? '');
                $table->addCell(1500)->addText($revisionTable['approved_by'][$index] ?? '');
                $table->addCell(1500)->addText($revisionTable['approved_by_date'][$index] ?? '');
                $table->addCell(1500)->addText($revisionTable['reason_of_revision'][$index] ?? '');
            }
        }

        // Add Title Styles
        $phpWord->addTitleStyle(1, ['bold' => true, 'size' => 18], ['alignment' => 'center']);
        $phpWord->addTitleStyle(2, ['bold' => true, 'size' => 16]);
        $phpWord->addTitleStyle(3, ['bold' => true, 'size' => 14, 'italic' => true]);

        // Create Table of Contents Section
        $tocSection = $phpWord->addSection();
        $tocSection->addTitle("Table of Contents", 1);
        $tocBookmarks = [];

        foreach ($tocItems as $index => $tocItem) {
            $bookmarkName = 'toc_' . $index;
            $tocBookmarks[] = $bookmarkName;
            $tocSection->addTextRun()->addLink('#' . $bookmarkName, $tocItem);
            $tocSection->addText($sections['section_titles'][$index], ['bold' => true]);
            if (isset($sections['subtitle_titles'][$index + 1])) {
                foreach ($sections['subtitle_titles'][$index + 1] as $subIndex => $subtitle) {
                    $bookmarkNameSub = $bookmarkName . '_sub' . $subIndex;
                    $tocBookmarks[] = $bookmarkNameSub;
                    $tocSection->addTextRun()->addLink('#' . $bookmarkNameSub, $subtitle);
                }
            }
        }

        // Content Section
        $contentSection = $phpWord->addSection();
        foreach ($tocItems as $index => $tocItem) {
            $bookmarkName = 'toc_' . $index;
            $contentSection->addTextRun()->addBookmark($bookmarkName);
            $contentSection->addTitle($sections['section_titles'][$index], 2);

            if (isset($sections['subtitle_titles'][$index + 1])) {
                foreach ($sections['subtitle_titles'][$index + 1] as $subIndex => $subtitle) {
                    $bookmarkNameSub = $bookmarkName . '_sub' . $subIndex;
                    $contentSection->addTextRun()->addBookmark($bookmarkNameSub);
                    $contentSection->addTitle($subtitle, 3);
                    // Add content
                    if (isset($sections['subtitle_contents'][$index + 1][$subIndex])) {
                        $content = $sections['subtitle_contents'][$index + 1][$subIndex];
                        $contentSection->addText($content);
                    } else {
                        $contentSection->addText("No content provided.");
                    }
                    // Add image  sectionif available
                    if (isset($sections['subtitle_images'][$index + 1][$subIndex])) {
                        $content = $sections['subtitle_images'][$index + 1][$subIndex];
                        $contentSection->addText($content);
                    } else {
                        $contentSection->addText("No content provided.");
                    }
                }
            }
            $contentSection->addPageBreak();
        }
        // Save file and return download response
        $fileName = $data->title . '_' . $data->document_number . '_file.docx';
        $tempFile = storage_path('app/' . $fileName);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
