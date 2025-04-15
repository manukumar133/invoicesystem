@extends('include.app')
@section('style')
    <style>
        textarea.form-control {
            font-family: 'Arial', sans-serif;
            font-size: 16px;
            color: #333;
            line-height: 1.5;
            background-color: #f8f9fa;
        }
    </style>
@endsection
@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon">
                                <i data-feather="eye">
                                </i>
                            </div>
                            View Invoice
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header">
                <a href="{{ route('user.invoice.index') }}" style="float: right" class="btn btn-sm btn-secondary"> Back</a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ $invoice->title }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Procedure Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle"
                            value="{{ $invoice->subtitle }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="documentNumber" class="form-label">Document Number</label>
                        <input type="text" class="form-control" id="documentNumber" name="document_number"
                            value="{{ $invoice->document_number }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="revisionTable" class="form-label">Revision Table</label>
                        <table class="table table-bordered" id="revisionTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Revision</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Reviewed By</th>
                                    <th>Reviewed Date</th>
                                    <th>Approved By</th>
                                    <th>Approved Date</th>
                                    <th>Reason of Revision</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $revisionTable = json_decode($invoice->revision_table, true);
                                    $tocItems = json_decode($invoice->toc_items, true);
                                    $sections = json_decode($invoice->sections, true);
                                @endphp
                                @foreach ($revisionTable['created_by'] as $index => $createdBy)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><input type="text" class="form-control" name="created_by"
                                                value="{{ $createdBy }}" readonly></td>
                                        <td><input type="text" class="form-control" name="created_by_date"
                                                value="{{ $revisionTable['created_by_date'][$index] }}" readonly></td>
                                        <td><input type="text" class="form-control" name="reviewed_by"
                                                value="{{ $revisionTable['reviewed_by'][$index] }}" readonly></td>
                                        <td><input type="text" class="form-control" name="reviewed_by_date"
                                                value="{{ $revisionTable['reviewed_by_date'][$index] }}" readonly></td>
                                        <td><input type="text" class="form-control" name="approved_by"
                                                value="{{ $revisionTable['approved_by'][$index] }}" readonly></td>
                                        <td><input type="text" class="form-control" name="approved_by_date"
                                                value="{{ $revisionTable['approved_by_date'][$index] }}" readonly></td>
                                        <td>
                                            <textarea class="form-control" name="reason_of_revision" readonly>{{ $revisionTable['reason_of_revision'][$index] }}</textarea>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Table of Contents -->
                    <div class="mb-3">
                        <label for="toc" class="form-label">Table of Contents</label>
                        <div id="tocContainer">
                            @foreach ($tocItems as $index => $tocItem)
                                <div class="d-flex mb-2">
                                    <input type="text" class="form-control toc-input" name="toc_items[]"
                                        value="{{ $tocItem }}" readonly>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- ------------------------------------------- --}}
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="sessionTabs" role="tablist">
                        @foreach ($tocItems as $index => $tocItem)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $index == 0 ? 'active' : '' }}"
                                    id="session-tab-{{ $index }}" data-bs-toggle="tab"
                                    data-bs-target="#session-{{ $index }}" type="button" role="tab"
                                    aria-controls="session-{{ $index }}"
                                    aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                    {{ trim($tocItem) }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="sessionContent">
                        @foreach ($tocItems as $index => $tocItem)
                            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                id="session-{{ $index }}" role="tabpanel"
                                aria-labelledby="session-tab-{{ $index }}">
                                <div class="mb-3">
                                    <label for="section-title-{{ $index }}" class="form-label">Section
                                        Title</label>
                                    <input type="text" class="form-control section-title"
                                        id="section-title-{{ $index }}" name="section_titles[]"
                                        value="{{ $sections['section_titles'][$index] ?? '' }}" readonly>
                                </div>

                                <div id="subtitles-{{ $index }}" class="mb-3">
                                    @if (isset($sections['subtitle_titles'][$index + 1]) && is_array($sections['subtitle_titles'][$index + 1]))
                                        @foreach ($sections['subtitle_titles'][$index + 1] as $subIndex => $subtitle)
                                            <div class="mb-3 subtitle-container">
                                                <div
                                                    class="subtitle-header d-flex justify-content-between align-items-center">
                                                    <input type="text" class="form-control subtitle-title"
                                                        name="subtitle_titles[{{ $index + 1 }}][{{ $subIndex }}]"
                                                        value="{{ $subtitle }}" readonly>
                                                </div>
                                                <div id="content-{{ $index + 1 }}-{{ $subIndex }}"
                                                    class="subtitle-content mt-3" style="display: block;">
                                                    <label for="subtitle-content-{{ $index + 1 }}-{{ $subIndex }}"
                                                        class="form-label">Subtitle Content</label>
                                                    <textarea class="form-control" id="subtitle-content-{{ $index + 1 }}-{{ $subIndex }}"
                                                        name="subtitle_contents[{{ $index + 1 }}][{{ $subIndex }}]" readonly>{{ $sections['subtitle_contents'][$index + 1][$subIndex] ?? '' }}</textarea>
                                                    <label
                                                        for="additional-image-upload-{{ $index + 1 }}-{{ $subIndex }}"
                                                        class="form-label">Paste or Upload Image</label>
                                                    <textarea contenteditable="true" class="form-control image-box"
                                                        id="additional-image-upload-{{ $index + 1 }}-{{ $subIndex }}"
                                                        name="subtitle_images[{{ $index + 1 }}][{{ $subIndex }}]"
                                                        style="min-height: 100px; border: 1px dashed #ccc;" readonly>{{ $sections['subtitle_images'][$index + 1][$subIndex] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- ------------------------------------------- --}}
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            window.onload = function() {
                var textareas = document.querySelectorAll('textarea');
                textareas.forEach(function(textarea) {
                    textarea.style.height = 'auto';
                    textarea.style.height = (textarea.scrollHeight) + 'px';
                });
            };
        </script>
    @endsection
