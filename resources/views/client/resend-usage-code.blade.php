@extends('layouts.app-client')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.client-menu')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __("Me renvoyer le code d'utilisation") }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('vouchers.resend.usage.code.post', $voucherid) }}" >
                            <div><h5>{{__('Les champs marqués par ')}} <b class="" style="color: red;">*</b> {{__('sont obligatoires')}}</h5></div>
                            <br>
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

                            {{--<div class="row mb-3">
                                <label for="serialnumber" class="col-md-5 col-form-label text-md-end">
                                    {{ __("N° Série") }}
                                    <b class="" style="color: red;">*</b>
                                </label>

                                <div class="col-md-7">
                                    <input
                                        id="serialnumber"
                                        type="text"
                                        class="form-control @error('serialnumber') is-invalid @enderror"
                                        name="serialnumber"
                                        value="{{ old('serialnumber') }}"
                                        required autocomplete="serialnumber" autofocus>

                                    @error('serialnumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>--}}
                            <input type="hidden" name="serialnumber" value="{{$serial_number}}">

                            <div class="field">
                                <label for="email" class="">
                                    <b><span>{{ __('Email') }}
                                            <b class="" style="color: red;">*</b></span></b>
                                </label>

                                {{--<div class="col-md-7">--}}
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $client->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                {{--</div>--}}
                            </div>

                            <div class="field">
                                <label for="password" class="">
                                    <b><span>{{ __('Mot de passe') }}
                                            <b class="" style="color: red;">*</b></span></b>
                                </label>

                                {{--<div class="col-md-7">--}}
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                        {{ __('Renvoyer') }}
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
