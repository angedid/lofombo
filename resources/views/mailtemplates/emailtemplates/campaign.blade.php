@php
    use App\Http\Controllers\GuestController;
@endphp
@extends('layouts.email-template')
@section('content')
    <div style="margin:0; padding:0;">
        <div style="margin:0; padding:0;">
            <div style="margin:0; padding:0;">
                <div style="margin:0; padding:0;">
                    <div style="margin:0 0 24px;">
                        <h3 style="margin:0 0 16px; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:22px; line-height:1.35; font-weight:bold;">{{ $data['subject'] }} <br></h3>
                    </div>

                    <div style="margin:0;">
                        <p style="margin:0 0 18px;">
                            {{$data['message']}}

                        </p>

                        <h5 style="margin:24px 0 12px; color:#49616c; font-size:16px; line-height:1.5; font-weight:bold;"> {{ __("Merci pour votre Fidélité.") }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
