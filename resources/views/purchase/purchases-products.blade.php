@php
    use App\Models\Config;
    use App\Models\Notification;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.menu')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 style="display: inline;">{{ __("Article de la plateforme") }}</h5>
                        <h5 style="display: inline; float: right;">
                            @if(count(Config::where('is_applicable', true)->get()) > 0)
                                <a href="{{ route('home.products.index')}}"
                                   style="text-decoration: none; font-size: x-large; color: green;"
                                   title="{{__('Ajouter un client')}}">
                                    <strong><span class="glyphicon glyphicon-plus">+</span></strong>
                                    <span style="font-size: initial;">{{ __('Ajouter') }}</span>
                                </a>
                            @endif
                        </h5>
                    </div>

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
                            @php
                                $products = \App\Models\Product::all();
                                $i = 1;
                            @endphp
                            @if(count($products) > 0)
                                <table class="table table-striped table-responsive table-bordered">
                                    <thead class="" style="color: darkred;">
                                    <th scope="col">
                                        {{ '#' }}
                                    </th>

                                    <th scope="col">
                                        {{ __("Nom Article") }}
                                    </th>

                                    <th scope="col">
                                        {{ __("Prix Unitaire (TTC)") }}
                                    </th>
                                    <th scope="col">
                                        {{ __("Enregistré le") }}
                                    </th>
                                    <th scope="col">
                                        {{ __("Action") }}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <th scope="row">
                                                {{$i}}
                                            </th>
                                            <td >
                                                {{$product->name}}
                                            </td>

                                            <td >
                                                {{$product->price}}
                                            </td>

                                            <td >
                                                {{Carbon::parse($product->creatd_at)->format('d-m-Y')}}
                                            </td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#confirm-delete-product-modal-{{$product->id}}"
                                                   style="text-decoration: none;">
                                                    <img src="{{asset('images/icons8-remove-24.png')}}" alt="">

                                                </a>
                                                <div class="modal fade" id="confirm-delete-product-modal-{{$product->id}}"
                                                     data-bs-backdrop="static"
                                                     data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="staticBackdropLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                    {{__("Supprimer le produit")}}: {{$product->name}}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST"
                                                                  action="{{route('home.products.delete', $product->id)}}"
                                                                  onsubmit="return true;">
                                                                <div class="modal-body">

                                                                    <input type="hidden" name="error" id="error"
                                                                           class="form-control @error('error') is-invalid @enderror">
                                                                    @error('error')
                                                                    <span class="invalid-feedback" role="alert"
                                                                          style="position: relative; width: 100%; text-align: center;">
                                                                    <strong>{{ $message }}</strong>
                                                                </span> <br/>
                                                                    @enderror

                                                                    @csrf
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Annuler
                                                                    </button>
                                                                    <button type="submit" class="btn btn-success">
                                                                        {{__("Confirmer")}}
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#confirm-update-product-modal-{{$product->id}}"
                                                   style="text-decoration: none;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<img src="{{asset('images/icons8-pencil-24.png')}}" alt="{{__("Modifier")}}">
                                                </a>
                                                <div class="modal fade" id="confirm-update-product-modal-{{$product->id}}"
                                                     data-bs-backdrop="static"
                                                     data-bs-keyboard="false" tabindex="-1"
                                                     aria-labelledby="staticBackdropLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                    {{__("Modifier le produit")}}: {{$product->name}}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <form method="POST"
                                                                  action="{{route('home.products.update', $product->id)}}"
                                                                  onsubmit="return true;">
                                                                <div class="modal-body">

                                                                    <input type="hidden" name="error" id="error"
                                                                           class="form-control @error('error') is-invalid @enderror">
                                                                    @error('error')
                                                                    <span class="invalid-feedback" role="alert"
                                                                          style="position: relative; width: 100%; text-align: center;">
                                                                    <strong>{{ $message }}</strong>
                                                                </span> <br/>
                                                                    @enderror

                                                                    @csrf

                                                                    <div><h5>{{__('Les champs marqués par ')}} <b class="" style="color: red;">*</b> {{__('sont obligatoires')}}</h5></div>
                                                                    <br>

                                                                    <div class="row mb-3" >
                                                                        <label for="name" class="col-md-5 col-form-label text-md-end">{{ __('Nom') }}
                                                                            <b class="" style="color: red;">*</b></label>

                                                                        <div class="col-md-7">
                                                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                                                                   name="name" value="{{ $product->name }}" required autocomplete="name" autofocus
                                                                                   placeholder="{{ __("Nom du produit") }}">
                                                                            @error('name')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3" >
                                                                        <label for="unit_price" class="col-md-5 col-form-label text-md-end">{{ __('Prix Unitaire (TTC)') }}
                                                                            <b class="" style="color: red;">*</b></label>

                                                                        <div class="col-md-7">
                                                                            <input id="unit_price" type="number" class="form-control @error('unit_price') is-invalid @enderror"
                                                                                   name="unit_price" value="{{$product->price}}" required autocomplete="unit_price" autofocus
                                                                                   placeholder="{{ __("Prix de vente") }}">
                                                                            @error('unit_price')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Annuler
                                                                    </button>
                                                                    <button type="submit" class="btn btn-success">
                                                                        {{__("Confirmer")}}
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $i = $i + 1; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
