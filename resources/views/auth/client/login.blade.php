@extends('layouts.app-client')

@section('content')
<div class="login-wrap">
    <div class="login-grid">
        <div class="login-visual">
            <div>
                <h2><span>Monitorer vos points de fidélité,<br>rassurez-vous que vous etes récompenses a chaque transaction.</span>
                    <span data-lang="en">Monitor your loyalty points,<br>verify that you has been top up at every transaction.</span></h2>
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
            <div class="">
                <div class="">{{ __('Connexion') }}</div>

                <div class="">
                    <form method="POST" action="{{ route('authentification.client.post') }}" id="login-form">
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
                        <input type="hidden" name="error" id="error" class="form-control @error('error') is-invalid @enderror">
                        {{--@error('error')
                        <span class="invalid-feedback" role="alert" style="position: relative; width: 100%; text-align: center;">
                                        <strong>{{ $message }}</strong>
                                    </span> <br/>
                        @enderror--}}
                        @csrf

                        <div class="field">
                            <label for="telephone" class="<b><span>"><b><span>{{ __('Numéro Mobile') }}</span></b></label>
                            {{--<div class="col-md-6">--}}
                                <input id="telephone" type="tel"
                                       class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                       value="{{ old('telephone') }}" required autocomplete="telephone"
                                       placeholder="{{__("Exemple: ")}} +237691179154"
                                       onkeyup="removeNonNumericCharaters(this);"
                                       autofocus>

                                @error('telephone')
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
                            {{--</div>--}}
                        </div>


                        <div class="field">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Connexion') }}
                                </button>

                               @if (Route::has('client.password.forgot'))
                                    <a class="btn btn-link" href="{{ route('client.password.forgot') }}">
                                        {{ __('Mot de passe oublié ?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <script type="text/javascript">
                        function removeNonNumericCharaters(theInput){
                            theInput.value = "+" + theInput.value.replace(/\D/g, '');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
