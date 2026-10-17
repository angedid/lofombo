@extends('layouts.email-template')
@section('content')
    <div style="margin:0; padding:0;">
        <div style="margin:0; padding:0;">
            <div style="margin:0; padding:0;">
                <div style="margin:0; padding:0;">
                    <div style="margin:0 0 24px;">
                        <h3 style="margin:0 0 16px; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:22px; line-height:1.35; font-weight:bold;">{{ __('Madame') . '/' . __('Monsieur'). ' ' . __("vous avez été enregistré à la plateforme de fidélité de") . ' '  . $data['enterprise'] }} <br></h3>
                    </div>

                    <div style="margin:0;">
                        <div>
                            {{ __("Vous pouvez accéder au système en utilisant le lien suivant") }}: &nbsp;
                            <a style="color:#5b4897; text-decoration:underline; overflow-wrap:anywhere; word-break:break-all;" href="{{$data['login_url']}}">{{$data['login_url']}}</a>
                            <br>
                            {{ __("Au premier accès, vous utiliserez les identifiants suivants pour accéder à la plateforme.") }}
                            <ul style="margin:16px 0 24px; padding:20px 20px 20px 36px; background-color:#f4f4f4; color:#49616c;">
                                <li style="margin:0 0 8px;">
                                    {{ __("Pseudo") }}: {{$data['pseudo']}}
                                </li>
                                <li style="margin:0 0 8px;">
                                    {{ __("Mot de passe") }}: {{'12345678'}}
                                </li>
                            </ul>
                            {{ __("Il vous sera demandé de changer ce mot de passe pour accéder aux multiples  fonctionnalités de la plateforme.") }}

                            <h5 style="margin:24px 0 12px; color:#49616c; font-size:16px; line-height:1.5; font-weight:bold;">{{ __("Merci pour votre collaboration.") }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
