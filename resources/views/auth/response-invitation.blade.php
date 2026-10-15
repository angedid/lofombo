@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.menu')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if(!session('error'))
                        {{ __('Cher') . ' ' . $invitation->name}}, {{ __("vous êtes invités a vous enregistrer au système de fidélité de ") }} <strong>{{$invitation->enterprise_name}}</strong>
                    @endif

                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('registration.invitation-response.index.post',$invitation->id) }}" >
                        @csrf

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{--{{ session('status') }}--}}
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{--<div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ 'Nom complet' }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ 'Adresse Email' }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>--}}

                        <div class="field">
                            <label for="password" class=""><b><span>{{ __("Mot de passe") }}</span></b></label>

                            {{--<div class="col-md-6">--}}
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
                                placeholder="Entre 8 et 20 caracteres">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            {{--</div>--}}
                        </div>

                        <div class="field">
                            <label for="password-confirm" class="">
                                <b><span>{{ __('Confirmation Mot de passe') }}</span></b></label>

                            {{--<div class="col-md-6">--}}
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            {{--</div>--}}
                        </div>

                        <div class="field">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Répondre à l'invitation") }}
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
