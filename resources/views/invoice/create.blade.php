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
                                <i data-feather="add">
                                </i>
                            </div>
                            Create Invoice
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
                <form id="documentForm" action="{{ route('user.invoice.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter the title">
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Procedure Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle"
                            placeholder="Enter the procedure subtitle">
                    </div>
                    <div class="mb-3">
                        <label for="documentNumber" class="form-label">Document Number</label>
                        <input type="text" class="form-control" id="documentNumber" name="document_number"
                            placeholder="Enter the document number">
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
                                <tr>
                                    <td>0</td>
                                    <td>
                                        <input type="text" class="form-control" name="created_by[]">
                                    </td>
                                    <td>
                                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control"
                                            name="created_by_date[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="reviewed_by[]">
                                    </td>
                                    <td>
                                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control"
                                            name="reviewed_by_date[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="approved_by[]">
                                    </td>
                                    <td>
                                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control"
                                            name="approved_by_date[]">
                                    </td>
                                    <td>
                                        <input type="textarea" class="form-control" name="reason_of_revision[]">
                                    </td>
                                </tr>
                                </thead>
                            <tbody>
                            <tfoot>
                                <td colspan="4" class="text-center">
                                    <button type="button" id="addRowButton" class="btn btn-success">
                                        <i class="fas fa-plus">
                                        </i> Add New Revison
                                    </button>
                                </td>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Table of Contents -->
                    <div class="mb-3">
                        <label for="toc" class="form-label">Table of Contents</label>
                        <div id="tocContainer">
                            <!-- Dynamic fields for Table of Contents -->
                        </div>
                        <button type="button" id="addTocField" class="btn btn-success mt-2">
                            <i class="fas fa-plus">
                            </i> Add Table of Contents Item
                        </button>
                    </div>
                    <ul class="nav nav-tabs" id="sessionTabs" role="tablist">
                    </ul>
                    <div class="tab-content" id="sessionContent">

                    </div>
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-file-alt">
                            </i> Generate Document
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // --------------------------------------------------
        $(document).ready(function() {
            $('.tab-content').on('input', 'textarea', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
        // --------------------------------------------------
        const tocContainer = $('#tocContainer');
        const tabList = $('#sessionTabs');
        const tabContent = $('#sessionContent');
        const addTocFieldButton = $('#addTocField');
        let tabCount = 0;

        // -------------------------- jQuery end here --------------------------
        $(addTocFieldButton).on('click', () => {
            tabCount++;
            // Create Table of Contents input field
            const tocInputContainer = $('<div>', {
                class: 'd-flex mb-2'
            });
            tocInputContainer.html(
                `<input type="text" class="form-control toc-input" name="toc_items[]" placeholder="Enter table of content item" data-tab-id="${tabCount}">`
            );
            tocContainer.append(tocInputContainer);
            // Create Tab
            const tabId = `session-tab-${tabCount}`;
            const contentId = `session-${tabCount}`;
            const newTab = $('<li>', {
                class: 'nav-item',
                role: 'presentation'
            });
            newTab.html(
                `<button class="nav-link" id="${tabId}" data-bs-toggle="tab" data-bs-target="#${contentId}" type="button" role="tab" aria-controls="${contentId}" aria-selected="false">Session ${tabCount}</button>`
            );
            tabList.append(newTab);

            // Create Tab Content
            const newContent = $('<div>', {
                class: 'tab-pane fade',
                id: contentId,
                role: 'tabpanel',
                'aria-labelledby': tabId
            });
            newContent.html(`<div class="mb-3">
            <label for="section-title-${tabCount}" class="form-label">Section Title</label>
                        <input type="text" class="form-control section-title" id="section-title-${tabCount}" name="section_titles[]" placeholder="Section title">
                    </div>
                    <div id="subtitles-${tabCount}" class="mb-3">
                        <button type="button" class="btn btn-secondary add-subtitle" data-tab-id="${tabCount}">Add Subtitle</button>
                    </div>`);
            tabContent.append(newContent);
        });
        // -------------------------- jQuery end here --------------------------
        $(tabContent).on('click', (event) => {
            if ($(event.target).hasClass('add-subtitle')) {
                const tabId = $(event.target).data('tab-id');
                const subtitlesContainer = $(`#subtitles-${tabId}`);

                // Create subtitle container
                const subtitleIndex = subtitlesContainer.children().length - 1; // Exclude the button
                const subtitleContainer = $(`<div class="mb-3 subtitle-container">
                <div class="subtitle-header d-flex justify-content-between align-items-center">
                    <input type="text" class="form-control subtitle-title" name="subtitle_titles[${tabId}][${subtitleIndex}]" placeholder="Enter subtitle">
                </div>
                <div id="content-${tabId}-${subtitleIndex}" class="subtitle-content mt-3">
                    <label for="subtitle-content-${tabId}-${subtitleIndex}" class="form-label">Subtitle Content</label>
                    <textarea class="form-control" id="subtitle-content-${tabId}-${subtitleIndex}" name="subtitle_contents[${tabId}][${subtitleIndex}]" placeholder="Enter subtitle content"></textarea>
                    <label for="additional-image-upload-${tabId}-${subtitleIndex}" class="form-label">Paste or Upload Image</label>
                    <textarea contenteditable="true" class="form-control image-box" id="additional-image-upload-${tabId}-${subtitleIndex}" name="subtitle_images[${tabId}][${subtitleIndex}]"  style="min-height: 100px; border: 1px dashed #ccc;"></textarea>
                </div>
            </div>`);
                // Add subtitle container above the button
                subtitleContainer.insertBefore($(event.target));
            }
        });
        // -------------------------- jQuery end here --------------------------
        $(tocContainer).on('input', '.toc-input', (event) => {
            const tabId = $(event.target).data('tab-id');
            const tabButton = $(`#session-tab-${tabId}`);
            const sectionTitle = $(`#section-title-${tabId}`);
            const inputValue = $(event.target).val().trim();
            if (tabButton.length) {
                tabButton.text(inputValue || `Session ${tabId}`);
                sectionTitle.val(inputValue || `Session ${tabId}`);
            }
        });
        // -------------------------- jQuery end here --------------------------

        // Dynamic Table Row Addition
        const revisionTable = document.getElementById('revisionTable').querySelector('tbody');
        const addRowButton = document.getElementById('addRowButton');
        let revisionCount = 0;
        addRowButton.addEventListener('click', () => {
            revisionCount++;
            const newRow = document.createElement('tr');
            newRow.innerHTML = `<td>${revisionCount}</td>
            <td><input type="text" class="form-control" name="created_by[]"></td>
            <td><input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="created_by_date[]"></td>
            <td><input type="text" class="form-control" name="reviewed_by[]"></td>
            <td><input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="reviewed_by_date[]"></td>
            <td><input type="text" class="form-control" name="approved_by[]"></td>
            <td><input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="approved_by_date[]"></td>
            <td><input type="textarea" class="form-control" name="reason_of_revision[]"></td>`;
            revisionTable.appendChild(newRow);
        });
        // -------------------------- jQuery end here --------------------------
    </script>
@endsection
