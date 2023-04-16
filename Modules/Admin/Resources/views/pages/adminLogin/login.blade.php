<!DOCTYPE html>

<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ asset('icons/favicon.ico') }}">
    <title>@yield('title', 'Tomosia')</title>

    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    @yield('css')
    @yield('library-head')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <style>
        .form-input {
            display: grid;
            padding: 0 36px;
        }

        .form-inline {
            text-align: center;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .form-login {
            border: 2px solid #616161;
            width: 400px;
            height: 500px;
            margin: auto;
        }

        .form-control {
            width: 300px;
        }

        .logo {
            height: 150px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div class="d-flex" style="height: 100vh;">
    <div class="form-login">
        <form class="form-inline" action="{{ route('admin::postLogin') }}" method="post">
            @csrf
            @method('POST')
            <div class="form-input">
                <div class="logo">
                    <img src="{{ asset('icons/logo.png')}}" alt="Logo Tomosia">
                </div>
                @if(session()->has('error'))
                   <span style="color: red; padding-bottom: 5px;"> {{ session()->get('error') }}</span>
                @endif
                <div class="form-group">
                    <input type="text" id="" class="form-control mx-sm-3" aria-describedby="passwordHelpInline"
                           placeholder="Email" name="email"
                           style="width: 300px; height: 40px; border-radius: 10px; border: 1px solid #616161;">
                    @error('email')
                    <span
                        style="color: #ff8888; font-size: 14px; text-align: initial;margin-left: 13px;margin-top: 2px; ">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="margin-top: 30px">
                    <input type="password" id="" class="form-control mx-sm-3" aria-describedby="passwordHelpInline"
                           placeholder="Password" name="password"
                           style="width: 300px; height: 40px;border: 1px solid #616161;border-radius: 10px">
                    @error('password')
                    <span
                        style="color: #ff8888; font-size: 14px;margin-left: 14px;padding-bottom: 10px;margin-top: 3px;text-align: initial;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="btn-login" style="margin-top: 50px">
                    <button type="submit" class="btn"
                            style="width: 150px; background-color: #64b5f7; height: 40px; border-radius: 5px;">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{--<script src="{{ asset('js/coreui.bundle.min.js') }}"></script>--}}
<script src="{{ asset('js/coreui-utils.js') }}"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
@yield('library-footer')
@yield('javascript')
</body>
</html>
