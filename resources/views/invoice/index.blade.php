@extends('include.app')
@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="filter"></i></div>
                            All Invoice
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
                <a href="{{ route('user.invoice.create') }}" style="float: right" class="btn btn-sm btn-primary"> Create</a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Document Number</th>
                            <th>Create Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->subtitle }}</td>
                                <td>{{ $item->document_number }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('user.invoice.show', $item->id) }}" target="_blank"
                                            class="btn btn-sm"><i class="fa fa-eye text-success"></i></a>
                                        {{-- -------- show button end here  --}}
                                        <a href="{{ route('user.invoice.edit', $item->id) }}" target="_blank"
                                            class="btn btn-sm"><i class="fa fa-edit text-primary"></i></a>
                                        {{-- -------- edit button end here  --}}
                                        <form method="POST" action="{{ route('user.invoice.duplicate', $item->id) }}"
                                            class="m-0 p-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm duplicate-invoice"><i
                                                    class="fa fa-copy text-warning"></i></button>
                                        </form>
                                        {{-- -------- duplicate button end here  --}}
                                        <form method="POST" action="{{ route('user.invoice.download', $item->id) }}"
                                            class="m-0 p-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm download-invoice"><i
                                                    class="fa fa-download text-primary"></i></button>
                                        </form>
                                        {{-- -------- download button end here  --}}
                                        <form method="POST" action="{{ route('user.invoice.destroy', $item->id) }}"
                                            class="m-0 p-0">
                                            <input name="_method" type="hidden" value="DELETE">
                                            @csrf
                                            <button type="submit" class="btn btn-sm delete-invoice"><i
                                                    class="fa fa-trash text-danger"></i></button>
                                        </form>
                                        {{-- -------- delete button end here  --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            const datatablesSimple = $('#datatablesSimple');
            new simpleDatatables.DataTable(datatablesSimple[0], {
                perPage: 25 // Set the default number of rows per page
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.duplicate-invoice').click(function(e) {
                e.preventDefault();
                var form = $(this).closest("form");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to duplicate this invoice?",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, duplicate it!',
                    confirmButtonColor: 'green',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire('Done!', 'Invoice has been duplicated!', 'success');
                    } else {
                        Swal.fire('Cancelled', 'Your process is cancelled 🤗', 'error');
                    }
                });
            });
            // ---------------------------- duplicate jQuery ajax end here
            $('.download-invoice').click(function(e) {
                e.preventDefault();
                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to download this file?",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, download it!',
                    confirmButtonColor: 'green',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire('Done!', 'File has been downloaded!', 'success');
                    } else {
                        Swal.fire('Cancelled', 'Your process is cancelled 🤗', 'error');
                    }
                });
            });
            // ---------------------------- download jQuery ajax end here
            $('.delete-invoice').click(function(e) {
                e.preventDefault();
                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will be gone forever",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    confirmButtonColor: 'green',
                    cancelButtonText: 'Cancel',
                    dangerMode: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire('Done!', 'Data has been deleted!', 'success');
                    } else {
                        Swal.fire('Cancelled', 'Your data is safe 🤗', 'error');
                    }
                });
            });
            // ---------------------------- delete jQuery ajax end here
        });
    </script>
@endsection
