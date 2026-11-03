@extends('layouts.app-client')
@php
    use App\Http\Controllers\GuestController;
@endphp
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.client-menu')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Réinitialisation Mot de passe') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.reset.client.post', ['locale' => GuestController::getApplicationLocal()]) }}">
                        @csrf

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


                        {{--<input type="hidden" name="token" value="{{ csrf_token() }}">--}}
                        <input type="hidden" name="telephone" value="{{ Auth::guard('client')->user()->telephone }}">

                        {{--<div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>--}}

                        <div class="field">
                            <label for="Rename…" class="">
                                <b><span>{{ __('Mot de passe courant') }}</span></b></label>

                            {{--<div class="col-md-6">--}}
                                <input id="current-pwd" type="password" class="form-control @error('currentpassword') is-invalid @enderror" name="currentpassword" required autocomplete="currentpassword">

                                @error('currentpassword')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            {{--</div>--}}
                        </div>

                        <div class="field">
                            <label for="password" class="">
                                <b><span>{{ __('Password') }}</span></b></label>

                            {{--<div class="col-md-6">--}}
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            {{--</div>--}}
                        </div>

                        <div class="field">
                            <label for="password-confirm" class="">
                                <b><span>{{ __('Confirmation Mot de passe') }}
                                    </span></b></label>

                            {{--<div class="col-md-6">--}}
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            {{--</div>--}}
                        </div>

                        <div class="field">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Changer le mot de passe' }}
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
