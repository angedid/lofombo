@extends('layouts.email-template')
@section('content')
    <div style="margin:0; padding:0;">
        <div style="margin:0; padding:0;">
            <div style="margin:0; padding:0;">
                <div style="margin:0; padding:0;">
                    <div style="margin:0 0 24px;">
                        <h1 style="margin:0 0 16px; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:22px; line-height:1.35; font-weight:bold;">{{ 'Recuperation du mot de passe' }} <br></h1>
                    {{ __('Mme'). '/' . __('M.') . ' ' . $data['name'] }}
                    </div>

                    <div style="margin:0;">
                        <p style="margin:0 0 18px;">
                            {{ __('L\'application') }} {{env('APP_NAME')}} {{' '}}
                            {{ __('vient de recevoir votre demande de récupération de votre mot de passe. Nous vous prions de cliquer sur le bouton ci-dessous pour poursuivre l\'opération sollicitée.') }}
                            <br>
                        </p>

                        <a style="color:#5b4897; text-decoration:underline; overflow-wrap:anywhere; word-break:break-all;" href="{{$data['passwordRecoveringUrl']}}" >{{ __('Cliquez ici pour récupérer votre mot de passe') }}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
