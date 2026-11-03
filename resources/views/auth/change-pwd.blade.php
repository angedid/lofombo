@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;
    use App\Http\Controllers\GuestController;

    /*if (Auth::check()){
        Session::flush();
        Auth::logout();
    }*/

@endphp
@extends('layouts.app-change-pwd')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{--@include('layouts.menu')--}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modification du mot de passe') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.reset.first.time.post', ['locale' => GuestController::getApplicationLocal()]) }}">
                            <div>
                                <h5>{{__('Les champs marqués par ')}} <b class="" style="color: red;">*</b> {{__('sont obligatoires')}}</h5>
                            </div>
                            <br>
                            @csrf
                            @if (session('status'))
                                <div class="alert alert-danger" role="alert">
                                    <b>{{ session('status') }}</b>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            {{-- @if (isset($status))
                                 <div class="alert alert-info" role="alert">
                                     {{ $status }}
                                 </div>
                             @endif--}}

                            <h5>{{ __('Bien vouloir changer votre mot de passe') }}</h5>

                            <div class="field">
                                <label for="password" class="">
                                    <b><span>{{ __('Mot de passe') }}
                                            <b class="" style="color: red;">*</b></span></b>
                                </label>

                                {{--<div class="col-md-6">--}}
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                {{--</div>--}}
                            </div>

                            <div class="field">
                                <label for="password-confirm" class="">
                                    <b><span>{{ __('Confirmer') }}
                                            <b class="" style="color: red;">*</b></span></b>
                                </label>
                                {{--<div class="col-md-6">--}}
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                {{--</div>--}}
                            </div>

                            <input type="hidden" name="userid" value="{{$user->id}}">


                            <div class="field">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Changer') }}
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
