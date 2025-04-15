<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Invoice Admin Panel</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('front/assets/img/favicon.png') }}">
    <link href="{{ URL::asset('front/npm/datatables/dist/style.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('front/css/styles.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('front/ajax/libs/font-awesome/6.3.0/js/all.min.js') }}"></script>
    <script src="{{ URL::asset('front/ajax/libs/feather-icons/4.29.0/feather.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @yield('style')
</head>

<body class="nav-fixed">
    @include('include.header')
    <div id="layoutSidenav">
        @include('include.sidebar')
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            <footer class="footer-admin mt-auto footer-light">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright © Your Website 2021</div>
                        <div class="col-md-6 text-md-end small">
                            <a href="#!">Privacy Policy</a>
                            <a href="#!">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <script src="{{ URL::asset('front/npm/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('front/js/scripts.js') }}"></script>
    <script src="{{ URL::asset('front/npm/datatables/dist/umd/simple-datatables.min.js') }}"></script>
    <script>
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: false,
            positionClass: "toast-top-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
        };
        // ------------toastr End here-----------
        @if (session('success'))
            $(document).ready(function() {
                toastr["success"]("{{ session('success') }}", 'Success!');
            });
        @elseif (session('error'))
            $(document).ready(function() {
                toastr["error"]("{{ session('error') }}", 'Error!');
            });
        @endif
    </script>
    @yield('script')
</body>

</html>
