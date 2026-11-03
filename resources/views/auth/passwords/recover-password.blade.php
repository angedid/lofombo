@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Réinitialisation du mot de passe')}} </div>

                    <div class="card-body">
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

                        <form method="POST" action="{{ route('password.forgot.post.form') }}">
                            @csrf

                            <input id="requestid" type="hidden" class="form-control" name="requestid" value="{{ $requestId }}" required >

                            <div class="field">
                                <label for="password" class=""><b><span>{{ __('Password') }}</span></b></label>

                                {{--<div class="col-md-6">--}}
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                               {{-- </div>--}}
                            </div>

                            <div class="field">
                                <label for="password-confirm" class=""><b><span>{{ __('Confirmation Mot de passe') }}</span></b></label>

                                {{--<div class="col-md-6">--}}
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                {{--</div>--}}
                            </div>

                            <div class="field">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        {{__("Réinitialiser")}}
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
