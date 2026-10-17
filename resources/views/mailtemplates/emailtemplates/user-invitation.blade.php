@extends('layouts.email-template')
@section('content')
    <div style="margin:0; padding:0;">
        <div style="margin:0; padding:0;">
            <div style="margin:0; padding:0;">
                <div style="margin:0; padding:0;">
                    <div style="margin:0 0 24px;">
                        <h3 style="margin:0 0 16px; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:22px; line-height:1.35; font-weight:bold;">{{ 'Invitation a s\'enregistrer  au systeme de fidelite de ' . $data['enterprise'] }} <br></h3>
                    {{ 'Mme/M. ' . $data['name'] }}
                    </div>

                    <div style="margin:0;">
                        <p style="margin:0 0 18px;">
                            Vous avez ete invite par le systeme de fidelite de l'entreprise  <strong>{{$data['enterprise']}} </strong>.
                            a vous enregistrer.
                            <br>

                        </p>
                        <p style="margin:0 0 18px;">
                            {{ __("Vous pouvez accéder au système en utilisant le lien suivant") }}: &nbsp;
                            <a style="color:#5b4897; text-decoration:underline; overflow-wrap:anywhere; word-break:break-all;" href="{{$data['invitation_url']}}">{{$data['invitation_url']}}</a>
                            <br>
                        </p>

                            <h5 style="margin:24px 0 12px; color:#49616c; font-size:16px; line-height:1.5; font-weight:bold;">{{ __("Merci pour votre Fidélité.") }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
