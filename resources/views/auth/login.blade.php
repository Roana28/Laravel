<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>PT. Winnicode Garuda Teknologi</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
</head>

<body style="background-color: white;">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="section" style="text-align: center; margin-top: 50px;">
                <img src="{{ asset('assets/img/login/login.png') }}" alt="image" style="width: 360px !important; height: auto !important; display: block; margin: auto;">
                <h2 style="text-align: center; font-weight: bold; font-size: 22px; margin-top: 10px;">
                    FOR <span style="background-color: #DC3583FF; color: white; padding: 4px 12px; border-radius: 20px;">EMPLOYEE</span>
                </h2>
            </div>

            <!-- FORM BAGIAN INI -->
             <!-- Ionicons untuk ikon -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

            <style>
                body {
                    background: url('background.jpg') no-repeat center center;
                    background-size: cover;
                    font-family: Arial, sans-serif;
                }

                .login-container {
                    max-width: 320px;
                    margin: 100px auto;
                    padding: 30px 20px;
                    background-color: rgba(255, 255, 255, 0.8);
                    border-radius: 16px;
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }

                .login-title {
                    font-size: 24px;
                    font-weight: bold;
                    margin-bottom: 20px;
                    color: #DC3583FF;
                }


                .input-group input {
                    width: 100%;
                    padding: 12px 40px 12px 40px;
                    border: 2px solid #DC3583FF;
                    border-radius: 40px;
                    font-size: 16px;
                    outline: none;
                }

                .input-group .icon {
                    position: absolute;
                    left: 15px;
                    top: 50%;
                    transform: translateY(-50%);
                    font-size: 20px;
                    color: #DC3583FF;
                }

                .login-button {
                    width: 100px;
                    height: 100px;
                    background-color: #3366ff;
                    color: white;
                    border-radius: 50%;
                    border: none;
                    font-size: 16px;
                    font-weight: bold;
                    margin: 20px auto;
                    cursor: pointer;
                }

            </style>

            <!-- FORM -->
             
            <div class="login-container">
                <form action="/proseslogin" method="POST">
                    @csrf   
                    
            {{-- 🔔 Pesan Error Login --}}
            @if(session('error'))
                    <div style="
                        background-color: #ffdddd;
                        color: #d8000c;
                        border: 1px solid #d8000c;
                        padding: 10px 15px;
                        border-radius: 10px;
                        margin-bottom: 15px;
                        font-size: 14px;
                        font-weight: bold;
                        text-align: center;
                    ">
                        {{ session('error') }}
                    </div>
                @endif

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-links mt-2">
                        <div><a href="page-forgot-password.html" class="text-muted">Forgot Password?</a></div>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset ('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap-->
    <script src="{{ asset ('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset ('assets/js/lib/bootstrap.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset ('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset ('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset ('assets/js/base.js') }}"></script>


</body>

</html>