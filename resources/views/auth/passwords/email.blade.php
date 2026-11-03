@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Récupération du mot de passe') }}</div>

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

                    <form method="POST" action="{{ route('password.forgot.post') }}">
                        @csrf
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
                                    {{ __('Lien de réinitialisation du mot de passe') }}
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
