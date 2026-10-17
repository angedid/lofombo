@extends('layouts.email-template')
@section('content')
    <div style="margin:0; padding:0;">
        <div style="margin:0; padding:0;">
            <div style="margin:0; padding:0;">
                <div style="margin:0; padding:0;">
                    <div style="margin:0 0 24px;">
                        <h3 style="margin:0 0 16px; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:22px; line-height:1.35; font-weight:bold;">{{ __('Disponibilité de récompenses à travers les Bons de Fidélité') }} <br></h3>
                    </div>

                    <br/>

                    <p>
                        {{__('Cher Client, Votre nombre de Point de Fidélité est :')}} {{$data['totalPoint']}}
                    </p>

                    <div style="margin:0;">
                        <h4 style="margin:0 0 18px; color:#49616c; font-size:16px; line-height:1.5; font-weight:normal;">{{$data['msg'][0]}}</h4>
                        @php $i = 0; @endphp
                        <ul style="margin:16px 0 24px; padding:20px 20px 20px 36px; background-color:#f4f4f4; color:#49616c;">
                            @foreach($data['msg'] as $msg)
                                @if($i > 0)
                                    <li style="margin:0 0 8px;">{{$msg}}</li>
                                @endif
                                @php $i = $i + 1; @endphp
                            @endforeach
                        </ul>



                        <h5 style="margin:24px 0 12px; color:#49616c; font-size:16px; line-height:1.5; font-weight:bold;">{{ __("Merci pour votre Fidélité.") }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
