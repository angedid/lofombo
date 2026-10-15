@php use App\Models\Config; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @include('layouts.menu')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h5>{{ __("Enregistrer une produit") }}</h5></div>
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

                        <form method="POST" action="{{ route('home.products.index.post') }}" enctype="multipart/form-data">
                            @csrf
                            <div><h5>{{__('Les champs marqués par ')}} <b class="" style="color: red;">*</b> {{__('sont obligatoires')}}</h5></div>
                            <br>

                            <div class="field" >
                                <label for="name" class="">
                                    <b><span>{{ __('Nom') }}
                                            <b class="" style="color: red;">*</b></span></b></label>

                                {{--<div class="col-md-7">--}}
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                           placeholder="{{ __("Nom du produit") }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                {{--</div>--}}
                            </div>

                            <div class="field" >
                                <label for="unit_price" class="">
                                    <b><span>{{ __('Prix Unitaire (TTC)') }}
                                            <b class="" style="color: red;">*</b></span></b></label>

                                {{--<div class="col-md-7">--}}
                                    <input id="unit_price" type="number" class="form-control @error('unit_price') is-invalid @enderror"
                                           name="unit_price" value="{{ old('unit_price') }}" required autocomplete="unit_price" autofocus
                                           placeholder="{{ __("Prix de vente") }}">
                                    @error('unit_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                {{--</div>--}}
                            </div>

                            <div class="field">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enregistrer') }}
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

