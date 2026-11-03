@extends('layouts.app-client')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Recovering Password' }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{--{{ session('status') }}--}}
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{--{{ session('status') }}--}}
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('client.password.forgot.post') }}">
                        @csrf

                        <div class="field">
                            <label for="telephone" class=""><b><span>{{ __('Numéro Mobile') }}</span></b></label>

                            {{--<div class="col-md-6">--}}
                                <input id="telephone" type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>
                                @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            {{--</div>--}}
                        </div>

                        <div class="field">
                            <label for="email" class=""><b><span>{{ __('Email') }}</span></b></label>

                            {{--<div class="col-md-6">--}}
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            {{--</div>--}}
                        </div>

                        <div class="field">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Demande Lien de modification Mot de passe') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
