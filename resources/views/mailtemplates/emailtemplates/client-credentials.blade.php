@extends('layouts.email-template')
@section('content')
    <div style="margin:0; padding:0;">
        <div style="margin:0; padding:0;">
            <div style="margin:0; padding:0;">
                <div style="margin:0; padding:0;">
                    <div style="margin:0 0 24px;">
                        <h3 style="margin:0 0 16px; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:22px; line-height:1.35; font-weight:bold;">{{ __("Enregistrement à la plateforme de fidélité du commerçant") . ' ' . $data['enterprise'] }} <br></h3>
                    {{ $data['gender'] . ' ' . $data['name'] }}
                    </div>

                    <div style="margin:0;">
                        <p style="margin:0 0 18px;">
                            {{ __("Vous avez été enregistré avec succès au le système de fidélité de l'entreprise") }}  <strong>{{$data['enterprise']}} </strong>.
                            <br>

                        </p>
                        <p style="margin:0 0 18px;">
                            {{ __("Vous pouvez accéder au système en utilisant les identifiants suivants") }}:
                        </p>
                            <ul style="margin:16px 0 24px; padding:20px 20px 20px 36px; background-color:#f4f4f4; color:#49616c;">
                                <li style="margin:0 0 8px;">
                                    {{ __("Téléphone") }}: {{$data['telephone']}}
                                </li>
                                <li style="margin:0 0 8px;">
                                    {{ __("Mot de passe") }}: {{$data['secret']}}
                                </li>

                            </ul>

                            <h5 style="margin:24px 0 12px; color:#49616c; font-size:16px; line-height:1.5; font-weight:bold;">{{ __("Merci pour votre Fidélité.") }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
