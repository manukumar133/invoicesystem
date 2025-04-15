<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login </title>
    <link href="{{ URL::asset('front/css/styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('front/assets/img/favicon.png') }}">
    <script src="{{ URL::asset('front/ajax/libs/feather-icons/4.29.0/feather.min.js') }}" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-xl px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center">
                                    <h3 class="fw-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('try_login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Username</label>
                                            <input class="form-control" id="inputEmailAddress" type="text"
                                                placeholder="Enter username" name="username"
                                                value="{{ old('username') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control" id="inputPassword" type="password"
                                                placeholder="Enter password" name="password"
                                                value="{{ old('password') }}">
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" id="rememberPasswordCheck"
                                                    type="checkbox" value="">
                                                <label class="form-check-label" for="rememberPasswordCheck">Remember
                                                    password</label>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="auth-password-basic.html">Forgot Password?</a>
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="footer-admin mt-auto footer-dark">
                <div class="container-xl px-4">
                    <div class="row">
                        <div class="col-md-6 small">Copyright © Your Website {{ date('Y') }}</div>
                        <div class="col-md-6 text-md-end small">
                            {{-- <a href="">Privacy Policy</a>
                            ·
                            <a href="">Terms &amp; Conditions</a> --}}
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


</body>

</html>
