@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid">
        <div class="row py-5 px-4">
            <div class="col-sm-5  col-12 d-flex justify-content-center">
                <form method="POST" action="{{ route('login') }}" class="ent_f text-center">
                    @csrf
                    <h2 class="pt-2">Вхід</h2>
                    <a href="{{ route('register') }}" class="reg pt-2">
                        Я не маю акаунту. Зареєструватись
                    </a>
                    
                    <div class="form1 text-center pb-3">
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Введіть email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                         </div>
                         <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                         </div>
                    </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Запам'ятати мене
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Вхід
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Забули пароль?
                            </a>
                        @endif
                </form>
            </div>
            <div class="col-sm-7">
                <p class="loz">Шукай допомоги в інших<br>користувачів, та не забувай<br>використовувати і свої<br>знання!!!</p>
            </div>
        </div>
    </div>
</main>
@endsection
