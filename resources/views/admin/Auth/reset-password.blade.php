<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Forgot Password Page</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('admin/assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('admin/assets/modules/bootstrap-social/bootstrap-social.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/components.css')}}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA --></head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{asset('admin/assets/img/stisla-fill.svg')}}" alt="logo" width="100"
                             class="shadow-light rounded-circle">
                    </div>
                    <div class="card card-primary">
                        <div class="card-header"><h4>Reset Password</h4></div>
                        <div class="card-body">
                            <form method="POST" action="{{route('admin.reset-password.send')}}"
                                  class="needs-validation"
                                  novalidate="">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" value="{{@request()->email }}" type="email"
                                           class="form-control"
                                           name="email" tabindex="1"
                                           required autofocus>
                                    <input id="token" value="{{$token }}" type="hidden"
                                           class="form-control"
                                           name="token" tabindex="1"
                                           required autofocus>
                                    {{--                                    <input type="hidden" name="token" value="{{@request()->token }}">--}}
                                    @error('email')
                                    <code class="text-danger">{{ $message }}</code>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Please fill in your email
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" value="{{ old('password') }}" type="password"
                                           class="form-control"
                                           name="password" tabindex="1"
                                           required autofocus>
                                    @error('password')
                                    <code class="text-danger">{{ $message }}</code>
                                    @enderror
                                    <div class="invalid-feedback">
                                        Please fill in your password
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password Confirmation</label>
                                    <input id="password" value="{{ old('password_confirmation') }}" type="password"
                                           class="form-control"
                                           name="password_confirmation" tabindex="1"
                                           required autofocus>

                                    <div class="invalid-feedback">
                                        Please fill in your password confirmation
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="simple-footer">
                        Copyright &copy; <span class="text-primary">Abdallh Elzayat</span> 2024
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="{{asset('admin/assets/modules/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/modules/popper.js')}}"></script>
<script src="{{asset('admin/assets/modules/tooltip.js')}}"></script>
<script src="{{asset('admin/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('admin/assets/modules/moment.min.js')}}"></script>
<script src="{{asset('admin/assets/js/stisla.js')}}"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{asset('admin/assets/js/scripts.js')}}"></script>
<script src="{{asset('admin/assets/js/custom.js')}}"></script>
</body>
</html>
