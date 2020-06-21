@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid">
        <div class="row py-5 px-4">
            <div class="col-sm-5  col-12 d-flex justify-content-center">
                <div class="ent_f text-center">
                    <h2 class="pt-2">Реєстрація</h2>
                    <a href="{{ route('login') }}" class="reg pt-2">
                        У мене уже є акаунт.Вхід
                    </a>
                    <form action="{{ route('register') }}" method="POST" class="form1 text-center pb-3 pt-5">
                        @csrf
                        <div class="form-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Введіть нікнейм">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Введіть свій e-mail">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Придумайте пароль">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Введіть повторно пароль">
                        </div>
                        <button type="submit" class="btn btn-success">Зареєструватися</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-7">
                <p class="loz">Шукай допомоги в інших<br>користувачів, та не забувай<br>використовувати і свої<br>знання!!!</p>
            </div>
        </div>
    </div>
</main>
@endsection
