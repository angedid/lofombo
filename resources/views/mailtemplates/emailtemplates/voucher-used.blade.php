@extends('layouts.email-template')
@section('content')
    <div style="margin:0; padding:0;">
        <div style="margin:0; padding:0;">
            <div style="margin:0; padding:0;">
                <div style="margin:0; padding:0;">
                    <div style="margin:0 0 24px;">
                        <h3 style="margin:0 0 16px; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:22px; line-height:1.35; font-weight:bold;">{{ __("Bon Utilisé") }} <br></h3>
                    </div>

                    <div style="margin:0;">
                        <h4 style="margin:0 0 18px; color:#49616c; font-size:16px; line-height:1.5; font-weight:normal;">{{$data['msg'][0]}}</h4>
                        @if(isset($data['code']))
                            <div style="margin:16px 0 24px; padding:20px; background-color:#f4f4f4; color:#5b4897;">{{ __("") }}: {{$data['code']}}</div>
                        @endif
                        @php $i = 0; @endphp
                        <ul style="margin:16px 0 24px; padding:20px 20px 20px 36px; background-color:#f4f4f4; color:#49616c;">
                            @foreach($data['msg'] as $msg)
                                @if($i > 0)
                                    <li style="margin:0 0 8px;">{{$msg}}</li>
                                @endif
                                @php $i = $i + 1; @endphp
                            @endforeach
                        </ul>

                        <p style="margin:0 0 18px;">
                            {{ __("Pour plus de détail, cliquez sur le lien") }}:
                            <a style="color:#5b4897; text-decoration:underline; overflow-wrap:anywhere; word-break:break-all;" href="{{$data['clientLoginUrl']}}" >{{ __("Cliquez ici pour avoir les détails.") }}</a>
                        </p>

                        <h5 style="margin:24px 0 12px; color:#49616c; font-size:16px; line-height:1.5; font-weight:bold;">{{$data['config']->enterprise_name}} {{ __("vous remercie pour votre fidélité") }}.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
