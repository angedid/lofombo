@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.menu')
            <div class="col-md-9">
                <div class="card">
                    {{--<div class="card-header"><h3>{{ Auth::user()->name }}</h3></div>--}}
                    <div class="card-body">

                        <div>
                            <div
                                style="
                                /*text-align: center;
                                width: 100%;
                                font-size: 3em;
                                color: #164fa9;
                                font-weight: bold;
                                margin-top: 15px;
                                margin-bottom: 25px;*/
                                ">
                                <h2>{{__("Bienvenue sur LOFOMBO")}}: {{Auth::user()->name}}</h2>
                                <br/>
                                <p>
                                    {{__("Vue d'ensemble de votre programme de fidélité: Clients, points et récompenses en coup d'œil.")}}
                                </p>
                                <br/>
                            </div>
                        </div>
                        <div class="dashboard-stats">
                            <div class="dashboard-stat">
                                <div class="stat-card">
                                   <span class="label">
                                       {{__("Nom")}}
                                       <strong>{{Auth::user()->name}}</strong>
                                   </span>
                                </div>
                            </div>
                            <div class="dashboard-stat">
                                <div class="stat-card">
                                    <span class="label">
                                        {{__('Pseudo')}}
                                        <strong>{{Auth::user()->username}}</strong>
                                   </span>
                                </div>
                            </div>

                            <div class="dashboard-stat">
                                <div class="stat-card">
                                <span class="label">
                                   {{__('Email')}}
                                    <strong>{{Auth::user()->email}}</strong>
                               </span>
                                </div>
                            </div>


                            <div class="dashboard-stat">
                                <div class="stat-card">
                                <span class="label">
                                   {{__('Role')}}
                                    <strong>{{__('Vendeur')}}</strong>
                               </span>
                                </div>
                            </div>

                        </div>

                        <br/>

                        <div>
                            <H2>
                                {{__("Bienvenue sur LOFOMBO")}}
                            </H2>
                            <p>
                                {{__("LOFOMBO est votre solution complète de gestion de fidélité client: Enregistrement des achats, Suivi des points, gestion des récompenses et des bons de fidélité, le tout centralisé dans un seul tableau de bord. Utilisez le menu de gauche pour naviguer entre les différents modules de la plateforme.")}}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
