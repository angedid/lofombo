@php use SimpleSoftwareIO\QrCode\Facades\QrCode; @endphp

@extends('layouts.email-template')
@section('content')
    <div style="margin:0; padding:0;">
        <div style="margin:0; padding:0;">
            <div style="margin:0; padding:0;">
                <div style="margin:0; padding:0;">
                    <div style="margin:0 0 24px;">
                        <h3 style="margin:0 0 16px; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:22px; line-height:1.35; font-weight:bold;">
                            {{ __("Invitation à rejoindre la plateforme de fidélité"). " " . $data['enterprise'] }} <br>

                        </h3>
                        <h5 style="margin:24px 0 12px; color:#49616c; font-size:16px; line-height:1.5; font-weight:bold;">{{ __("Par") }} {{$data['inviter']}}</h5>
                    {{ __('Cher'). ' ' . $data['name'] }}, <br>
                        {{__('Vous avez été invité par ')}} {{$data['inviter']}}
                        {{__("à rejoindre la plateforme de fidélité")}}  {{$data['enterprise']}}
                    </div>
                    <div style="margin:0;">
                        <p style="margin:0 0 18px;">
                            {{__("Pour nous rejoindre, veuillez cliquer sur le lien ci-dessous.")}}
                            <br>

                        </p>


                            <h5 style="margin:24px 0 12px; color:#49616c; font-size:16px; line-height:1.5; font-weight:bold;">{{__("Merci pour votre fidélité.")}}</h5>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
