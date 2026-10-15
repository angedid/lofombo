@extends('layouts.app')

@section('content')
    <div class="login-wrap">
        <div class="login-grid">
            <div class="login-visual">
                <div>
                    <h2><span>Fidélisez vos clients,<br>récompensez chaque achat.</span><span data-lang="en">Build loyalty,<br>reward every purchase.</span></h2>
                    <p><span>La plateforme LOFOMBO centralise vos programmes de fidélité, vos points et vos récompenses en un seul endroit.</span><span data-lang="en">The LOFOMBO platform centralizes your loyalty programs, points and rewards in one place.</span></p>
                </div>
                <div class="fcard">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <div class="chip"></div>
                        <div class="dots"><span></span><span></span><span></span></div>
                    </div>
                    <div class="num">4829  ••••  ••••  0157</div>
                    <div class="foot">
                        <span data-lang="fr">CARTE FIDÉLITÉ</span><span data-lang="en">LOYALTY CARD</span>
                        <span class="pts">1 240 pts</span>
                    </div>
                </div>
                <p style="font-size:12px;opacity:.75;"><span data-lang="fr">Solution de gestion de fidélité — LOFOMBO</span><span data-lang="en">Loyalty management solution — LOFOMBO</span></p>
            </div>

            <div class="login-form">
                {{--<h1><span data-lang="fr">Connexion</span><span data-lang="en">Sign in</span></h1>
                <p class="sub"><span data-lang="fr">Accédez à votre espace d'administration.</span><span data-lang="en">Access your administration space.</span></p>

                <div class="login-error" id="login-error">
                    <span data-lang="fr">Nom d'utilisateur ou mot de passe incorrect.</span><span data-lang="en">Incorrect username or password.</span>
                </div>--}}

                {{--<div class="card">--}}
                    <h1><span>{{ __('Connexion') }}</span></h1>
                <p class="sub">
                    <span >
                        {{__("Accédez à votre espace d'administration.")}}
                    </span>
                </p>


                <div class="">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('authentification.post') }}" id="login-form">
                            <input type="hidden" name="error" id="error" class="form-control @error('error') is-invalid @enderror">
                            {{--@error('error')
                                <span class="invalid-feedback" role="alert" style="position: relative; width: 100%; text-align: center;">
                                    <strong>{{ $message }}</strong>
                                </span> <br/>
                            @enderror--}}

                            @csrf

                            <div class="field">
                                <label for="username" class=""><b><span>{{ __('Pseudo') }}</span></b></label>

                                {{--<div class="col-md-6">--}}
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                {{--</div>--}}
                            </div>

                            <div class="field">
                                <label for="password" class=""><b><span>{{ __('Mot de passe') }}</span></b></label>

                                {{--<div class="col-md-6">--}}
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                @if (Route::has('password.forgot'))
                                    <br/>
                                    <a class="text-md-end" href="{{ route('password.forgot') }}"
                                    style="text-align: right;">
                                        <b>{{ __('Mot de passe oublié ?') }}</b>
                                    </a>
                                @endif
                                {{--</div>--}}
                            </div>

                            {{--<div class="field">
                                <div class="">
                                    <div class="form-check" style="text-align: left;">
                                        <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Rester connecté') }}
                                        </label>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="field">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Connexion') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                {{--</div>--}}



                {{--<form id="login-form" onsubmit="return handleLogin(event)">
                    <div class="field">
                        <label><span data-lang="fr">Nom Utilisateur</span><span data-lang="en">Username</span></label>
                        <input type="text" id="username" autocomplete="username" required>
                    </div>
                    <div class="field">
                        <label><span data-lang="fr">Mot de passe</span><span data-lang="en">Password</span></label>
                        <input type="password" id="password" autocomplete="current-password" required>
                    </div>
                    <div class="row-between">
                        <span></span>
                        <a class="forgot"><span data-lang="fr">Mot de passe oublié ?</span><span data-lang="en">Forgot password?</span></a>
                    </div>
                    <button type="submit" class="btn-primary"><span data-lang="fr">Se connecter</span><span data-lang="en">Sign in</span></button>
                </form>--}}
            </div>
        </div>
    </div>

{{--<div class="container" id="page-login">
    <div class="row justify-content-center">
        <div class="col-md-8">

        </div>
    </div>
</div>--}}
@endsection
