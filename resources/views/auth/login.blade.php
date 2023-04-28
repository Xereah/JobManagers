@extends('layouts.app')
@section('content')
<style>
.gradient-custom-2 {
    /* fallback for old browsers */
    background: #fccb90;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}
body{
    font-family:serif;
}
#ukryty-tekst {
  display: none;
}
.smiley-button {
  border: none; /* usuń obramowanie */
  background: none; /* usuń tło */
  font-size: 1em; /* dostosuj rozmiar czcionki do wielkości przycisku */
  line-height: 1; /* ustaw linię na 1, aby wyśrodkować minkę */
  vertical-align: middle; /* wyśrodkuj w pionie */
}
@media (min-width: 768px) {
    .gradient-form {
        height: 100vh !important;
    }
}

@media (min-width: 769px) {
    .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
    }
}
</style>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    @if(session()->has('message'))
                    <p class="alert alert-info">
                        {{ session()->get('message') }}
                    </p>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1 align='center'>{{ trans('panel.site_title') }}</h1>
                        <!-- <p class="text-muted">{{ trans('global.login') }}</p> -->

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <input name="email" type="text"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus
                                placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                            @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input name="password" type="password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                                placeholder="{{ trans('global.login_password') }}">
                            @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-4">
                                    <div class="form-check checkbox">
                                        <input class="form-check-input" name="remember" type="checkbox" id="remember"
                                            value="1" style="vertical-align: middle;" />
                                        <label class="form-check-label" for="remember" style="vertical-align: middle;">
                                            {{ trans('global.remember_me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-link" href="{{ route('password.request') }}" >
                                    {{ trans('global.forgot_password') }}
                                </a>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ trans('global.login') }}
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                Wersja 1.2<br>
                                Data kompilacji 28.04.2023
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <!-- <button class="smiley-button float-right" id="pokaz-ukryj">😊</button>    -->
                <h1 class="mb-4"  style="font-family:Serif;" align="center" >Wiedza jest w firmie </h1>
                   
                    <div id="ukryty-tekst"> <h2 class="mb-4" align="center" >Ale nikt nie chce się nią podzielić</h2></div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
@section('scripts')
<script>
var button = document.getElementById("pokaz-ukryj");
var ukrytyTekst = document.getElementById("ukryty-tekst");

// dodaj nasłuchiwanie na kliknięcie przycisku
button.addEventListener("click", function() {
  // sprawdź, czy tekst jest widoczny
  if (ukrytyTekst.style.display === "none") {
    // jeśli jest ukryty, pokaż go
    ukrytyTekst.style.display = "block";
    button.classList.add("ukryj-tekst");
  } else {
    // jeśli jest widoczny, ukryj go
    ukrytyTekst.style.display = "none";
    button.classList.remove("ukryj-tekst");
  }
});
</script>
@endsection
