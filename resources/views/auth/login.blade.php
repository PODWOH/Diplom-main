@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #343a40; color: white;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #495057; border: none;">
                <div class="card-header text-center" style="background-color: #212529; color: white;">{{ __('Вход') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: white;">{{ __('Электронная почта') }}</label> <!-- Белый текст метки -->
                            <input id="email" type="email" class="form-control bg-dark text-white @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <div class="invalid-feedback" style="color: white;">
                                    <strong>{{ $message }}</strong> <!-- Белый цвет текста ошибки -->
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label" style="color: white;">{{ __('Пароль') }}</label> <!-- Белый текст метки -->
                            <input id="password" type="password" class="form-control bg-dark text-white @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <div class="invalid-feedback" style="color: white;">
                                    <strong>{{ $message }}</strong> <!-- Белый цвет текста ошибки -->
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="color: white;">{{ __('Запомнить меня') }}</label> <!-- Белый текст метки -->
                        </div>

                        <div class="d-flex justify-content-between mb-0">
                            <button type="submit" class="btn btn-light">
                                {{ __('Войти') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color: white;">
                                    {{ __('Забыли Свой Пароль?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection