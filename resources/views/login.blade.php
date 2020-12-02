<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <title>
        Login
    </title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous"
          rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <link href="{{ asset('css/jquery-ui.min.css') }}"
          rel="stylesheet">
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <link href="{{ asset('css/style.css') }}"
          rel="stylesheet">
</head>
<body>
<div class="container mt-md-5 mb-md-5">
    <div class="col-md-6 offset-md-3">
        <h3 class="text-center">
            Login
        </h3>
        <form action="/login" method="POST">
            @csrf

            <fieldset>

                @if(session('authentication'))
                    <div class="alert alert-danger">
                        {{ session('authentication') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">
                        E-Mail
                        <span class="mandatory">*</span>
                    </label>
                    <input type="text"
                           class="form-control @if(session('authentication')) is-invalid @endif @error('email') is-invalid @enderror"
                           name="email"
                           id="email"
                           value="{{ old('email') }}"
                           autocomplete="form-email-{{ csrf_token() }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">
                        Password
                        <span class="mandatory">*</span>
                    </label>
                    <input type="password"
                           name="password"
                           class="form-control @if(session('authentication')) is-invalid @endif @error('password') is-invalid @enderror"
                           id="password"
                           autocomplete="new-password">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group text-center">
                    <input type="submit"
                           class="btn btn-primary"
                           id="submit"
                           value="Login">
                </div>
                <hr>

                <div class="text-center">
                    <p>
                        New User?
                        <a href="/register">Register</a>
                    </p>
                </div>

                <hr>

                <div class="text-center">
                    <a href="/login/google" class="btn btn-danger">
                        Login via Google
                    </a>
                </div>

            </fieldset>

        </form>
    </div>
</div>
</body>
</html>
