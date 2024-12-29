<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Forgot Password</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Bellota+Text:ital,wght@0,300;0,400;0,700;1,300;1,700&amp;family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap'"
        rel="stylesheet">

    <style>
        :root {
            --black-color: #000000;
            --white-color: #FFFFFF;
            --dark-blue-color: #263246;
            --storm-blue-color: #61758A;
            --timber-green-color: #1C2A3A;
            --davy-gray-color: #445668;
            --smokey-grey-color: #6B6B6B;
            --pirate-gold-color: #BB8800;
            --gunmetal-color: #2D3748;
            --charcoal-grey-color: #374151;
            --hit-grey-color: #AAAFB5;
            --clear-blue-color: #1F78F0;
            --catalina-blue: #1E2D7B;
            --dodger-blue-color: #4294FF;
            --algal-fuel: #22cc74;
            --titanium-yellow-bg: rgba(255, 233, 33, 0.38);
            --quill-grey-bg: #D9D9D9;
            --dodger-blue-bg: #578BFF;
            --main-bg: linear-gradient(180deg,
                    rgba(231, 144, 54, 0.129) 0%,
                    rgba(231, 92, 42, 0.168) 24.98%,
                    rgba(182, 57, 41, 0.117) 51%,
                    rgba(85, 53, 187, 0.138) 75.99%,
                    rgba(203, 88, 162, 0.12) 100.97%,
                    rgba(136, 74, 181, 0.132) 126.99%,
                    rgba(32, 48, 208, 0.138) 153.01%,
                    rgba(100, 193, 237, 0.144) 176.95%,
                    rgba(91, 189, 205, 0.159) 199.85%),
                #FFFFFF;
            --white-bg: #FFFFFF;
        }

        html {
            box-sizing: border-box;
        }

        *,
        *::before,
        *::after {
            box-sizing: inherit;
        }

        ::selection {
            background-color: #2d3748;
            color: #fff;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--main-bg);
            min-height: 100vh;
            font-family: "Roboto";
        }

        *::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        *::-webkit-scrollbar {
            width: 6px;
            height: 6px;
            background-color: #F5F5F5;
        }

        *::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: linear-gradient(270deg, #3D70E0 0%, #C6A7FE 100%);
        }


        .main__login {
            padding: 60px 0 0;
        }

        @media (max-width: 768px) {
            .main__login .main__login-container {
                flex-direction: column;
                justify-content: center;
                gap: 40px;
            }
        }

        @media (max-width: 768px) {
            .main__login {
                padding: 40px 0 0;
            }
        }

        @media (max-width: 992px) {
            .main__login .login__logo {
                flex: 0 0 25%;
            }
        }

        @media (max-width: 768px) {
            .main__login .login__logo {
                text-align: center;
            }
        }

        .main__login .login__form-container {
            padding: 0 0 130px;
        }

        @media (max-width: 992px) {
            .main__login .login__form-container {
                flex: 0 0 70%;
            }
        }

        @media (max-width: 768px) {
            .main__login .login__form-container {
                padding: 0 0 40px;
            }
        }

        .main__login-container {
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
            padding: 0 20px;
        }

        .main__login h1 {
            font-family: 'Roboto';
            margin: 0 0 40px;
        }

        .main__login .login__fields {
            flex-direction: column;
            border: 0;
            padding: 0;
            display: flex;
        }

        .main__login label {
            font-family: 'Roboto';
            font-weight: 500;
            font-size: 14px;
            line-height: 16px;
            color: var(--charcoal-grey-color);
            margin-bottom: 10px;
        }

        .main__login .forget__password {
            font-family: 'Roboto';
            font-weight: 500;
            font-size: 14px;
            line-height: 16px;
            text-align: center;
            color: var(--clear-blue-color);
            text-align: right;
        }

        .main__login .forget__password a {
            color: var(--clear-blue-color);
        }

        .main__login .login__form-container form {
            max-width: 500px;
            width: 100%;
            margin: -130px auto 0;
            background: var(--white-bg);
            padding: 70px 40px;
        }

        @media (max-width: 1024px) {
            .main__login .login__form-container form {
                margin: 40px auto 0;
            }
        }

        @media (max-width: 640px) {
            .main__login .login__form-container form {
                padding: 40px 20px;
            }
        }

        .main__login .login__form-container form .input__wrapper {
            border: 1px solid #e8e9ec;
            padding: 15px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .main__login .login__form-container form input {
            border: none;
            outline: none;
            font-family: 'Roboto';
            font-weight: 400;
            font-size: 16px;
            line-height: 19px;
            color: var(--charcoal-grey-color);
        }

        .main__login .login__form-container form fieldset:not(:last-child) {
            margin-bottom: 20px;
        }

        .main__login .login__form-container form ::placeholder {
            font-family: 'Roboto';
            font-weight: 400;
            font-size: 16px;
            line-height: 19px;
            color: var(--hit-grey-color);
        }

        .main__login .login__form-container form button {
            border: none;
            background: none;
            outline: none;
            color: var(--hit-grey-color);
            padding: 0;
        }

        .main__login .login__form-container form button.submit__btn {
            font-family: 'Roboto';
            font-weight: 500;
            font-size: 18px;
            line-height: 21px;
            color: var(--white-color);
            padding: 14px;
            max-width: 100%;
            width: 100%;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            background-color: var(--dodger-blue-bg);
            margin: 34px 0 18px;
            border: 1px solid var(--dodger-blue-bg);
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .main__login .login__form-container form button.submit__btn:hover {
            color: var(--dodger-blue-bg);
            background: none;
        }

        .main__login .login__form-container form .register__now {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 16px;
            color: var(--hit-grey-color);
            margin-top: 25px;
        }

        .main__login .login__form-container form .register__now a {
            color: var(--clear-blue-color);
            transition: all 0.4s ease;
            text-decoration: underline;
        }

        .main__login .login__form-container form .register__now a:hover {
            color: var(--hit-grey-color);
        }

        .main__login .login__form-container form .hide__this {
            display: none;
        }

        .main__login .login__footer {
            border: 1px solid rgba(30, 45, 123, .2);
            padding: 23px 0;
        }

        .main__login .login__footer ul {
            max-width: 290px;
            width: 100%;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .main__login .login__footer ul li a {
            font-family: 'Bellota Text', cursive;
            color: var(--dodger-blue-color);
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            text-transform: capitalize;
            transition: all 0.4s ease;
        }

        .main__login .login__footer ul li a:hover {
            color: var(--hit-grey-color);
        }

        .main__login .login__footer .copy__text p {
            font-family: 'Bellota Text';
            font-weight: 400;
            font-size: 14px;
            line-height: 18px;
            text-align: center;
            letter-spacing: 0.24em;
            color: var(--catalina-blue);
            opacity: 0.4;
        }

        @media (max-width: 500px) {
            .google__login img {
                min-height: 51px;
                object-fit: cover;
                border-right: 1px solid #181c32;
                border-left: 1px solid #181c32;
            }
        }
    </style>

</head>

<body>

    <!-- <section id="auth_main">
        <div class="auth_align_main">
            <div class="auth_form">
                <div class="align_auth_height">
                    <form action="{{ route('reset') }}" method="POST">
                        @csrf
                        <input hidden name="token" placeholder="token" value="{{ request()->get('token') }}">
                        <div class="form_align_auth">
                            <div class="heading_form">
                                <h2>Reset Password</h2>
                                <p>Please set your new password.</p>
                            </div>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">{{ $error }}</div>
                                @endforeach
                            @endif
                            <div class="form_fields">
                                {{-- <div  class="form_field"> --}}
                                {{-- <label>Email</label> --}}
                                <input hidden class="w-100" name="email" placeholder="Enter email"
                                    value="{{ request()->get('email') }}">
                                {{-- </div> --}}

                                <div class="form_field">
                                    <label>New Password</label>
                                    <br>
                                    <input type="password" class="w-100" name="password"
                                        placeholder="Enter new password">
                                </div>
                                <div class="form_field">
                                    <label>Confirm New Password</label>
                                    <input type="password" class="w-100" name="password_confirmation"
                                        placeholder="Confirm new password">
                                </div>
                            </div>
                            <div class="submit_btn">
                                <button type="submit" class="btn btn-primary">Reset</button>
                            </div>
                        </div>
                    </form>

                    <div class="logo_auth">
                        <a href="#"><img src="{{ asset('public/assets/img/logo.svg') }}" class="img-fluid"></a>
                    </div>
                </div>
            </div>
            <div class="auth_image">
                <div class="align_auth_image">
                    <img src="{{ asset('public/assets/img/forget_reset.jpg') }}" class="img-fluid">
                </div>
            </div>
        </div>
    </section> -->

    <section class="main__login">
        <div class="main__login-container">
            <div class="login__logo">
                <a href="/">
                    <img src="{{ asset('images/img/login_logo.png') }}" alt="main_logo">
                </a>
            </div>
            <div class="login__form-container">
                <form action="{{ route('reset') }}" method="POST">
                    @csrf
                    <input hidden name="token" placeholder="token" value="{{ request()->get('token') }}">
                    <div class="form_align_auth">
                        <div class="heading_form">
                            <h2>Reset Password</h2>
                            <p>Please set your new password.</p>
                        </div>
                        <div class="form_fields">
                            {{-- <div  class="form_field"> --}}
                            {{-- <label>Email</label> --}}
                            <input hidden class="w-100" name="email" placeholder="Enter email" value="{{ request()->get('email') }}">
                            {{-- </div> --}}


                            <fieldset class="login__fields name__field d__flex">
                                <label for="login__name">New Password</label>
                                <div class="input__wrapper">
                                    <input type="password" class="w-100" name="password" id="password" placeholder="Enter new password">
                                </div>
                                <div class="alert alert-danger" id="password_msg" style="color:red" role="alert">
                                    @error('password') {{ $message }} @enderror
                                </div>
                            </fieldset>
                            <fieldset class="login__fields name__field d__flex">
                                <label for="login__name">Confirm New Password</label>
                                <div class="input__wrapper">
                                    <input type="password" class="w-100" name="password_confirmation" id="confirmPassword" placeholder="Confirm new password">
                                </div>
                                <div class="alert alert-danger" id="password_confirm_msg" style="color:red" role="alert">
                                    @error('password_confirmation') {{ $message }} @enderror
                                </div>
                            </fieldset>
                        </div>
                        <div class="submit_btn">
                            <button type="submit" class="submit__btn">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>

        const form = document.querySelector('form');
        const passwordField = form.querySelector('#password');
        const confirmPasswordField = form.querySelector('#confirmPassword');

        form.addEventListener('submit', function(event) {
            
            const password = passwordField.value.trim();
            const confirmPassword = confirmPasswordField.value.trim();

            document.getElementById('password_msg').innerText = "";
            document.getElementById('password_confirm_msg').innerText = "";
            if(password.length < 8){
                document.getElementById('password_msg').innerText = "password must be at least 8 characters";
                event.preventDefault();
            }
            else if (password !== confirmPassword) {
                document.getElementById('password_confirm_msg').innerText = "Password and confirm password don't match";
                event.preventDefault();
            }
        });

    </script>
</body>

</html>
