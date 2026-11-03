@php
    use App\Models\Config
  ; use App\Models\Loyaltyaccount
  ; use App\Models\Notification
  ; use Illuminate\Support\Carbon;use Illuminate\Support\Facades\Auth
  ; use App\Http\Controllers\GuestController
  ;
     $configuration = Config::where('is_applicable', true)->first();

@endphp
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Laravel') }}</title>--}}

    @if($configuration !== null)
        <title>{{ $configuration->enterprise_name }}</title>
    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root{
            --blue:#5A75F8;
            --mauve:#9788B3;
            --black:#000000;
            --white:#FFFFFF;
            --red:#FF0000;
            --card-bg:#FFFFFF;
            --sidebar-bg:#4761D8;
            --sidebar-hover:#6C85F9;
            --radius:10px;
            --shadow: 0 12px 32px rgba(20,20,40,.18);
        }
        *{box-sizing:border-box;}
        html,body{margin:0;padding:0;}
        body{
            /*font-family:'Inter',sans-serif;*/
            color:var(--black);
            background: linear-gradient(135deg,var(--blue) 0%, var(--mauve) 100%);
            min-height:100vh;
            font-size: initial;
            font-family: 'DejaVu Sans Light';
            /*margin: 0;
            padding: 0;*/
        }
        h1,h2,h3,.brand,.menu-title{font-family:'Sora',sans-serif;}
        a{cursor:pointer;}
        button{cursor:pointer;font-family:'Inter',sans-serif;}
        [data-lang]{display:none;}
        .lang-fr [data-lang="fr"]{display:inline;}
        .lang-en [data-lang="en"]{display:inline;}
        .lang-fr [data-lang="fr"].block{display:block;}
        .lang-en [data-lang="en"].block{display:block;}

        /* ---------- HEADER (shared) ---------- */
        .topbar{
            display:flex;align-items:center;justify-content:space-between;
            padding:14px 28px;
            background:var(--white);
            box-shadow:0 2px 10px rgba(20,20,50,.08);
        }
        .brand{display:flex;align-items:center;gap:10px;color:var(--black);font-weight:700;font-size:20px;letter-spacing:.3px;}
        .brand-logo{height:38px;width:auto;display:block;}
        .topbar-right{display:flex;align-items:center;gap:16px;}
        .lang-switch{display:flex;gap:2px;background:#EEF0FE;border-radius:20px;padding:3px;}
        .lang-switch button{
            border:none;background:transparent;color:var(--blue);
            padding:6px 14px;border-radius:20px;font-size:13px;font-weight:600;
            transition:.2s;
        }
        .lang-switch button.active{background:var(--blue);color:var(--white);}
        /*.lang-switch option.active{background:var(--blue);color:var(--white);}*/
        .settings-link{
            display:flex;align-items:center;gap:6px;color:var(--blue);
            font-size:14px;font-weight:500;background:#EEF0FE;
            padding:8px 14px;border-radius:8px;border:none;
        }
        .settings-link:hover{background:#DCE1FC;}

        /* ---------- LOGIN PAGE ---------- */
        #page-login{min-height:100vh;display:flex;flex-direction:column;}
        .login-wrap{
            flex:1;display:flex;align-items:center;justify-content:center;
            padding:40px 20px;
        }
        .login-grid{
            display:grid;grid-template-columns:1.1fr 1fr;
            max-width:920px;width:100%;
            background:var(--card-bg);
            border-radius:18px;overflow:hidden;
            box-shadow:var(--shadow);
        }
        .login-visual{
            background:linear-gradient(160deg, var(--mauve) 0%, var(--blue) 100%);
            padding:44px;display:flex;flex-direction:column;justify-content:space-between;
            color:var(--white);
        }
        .login-visual h2{font-size:22px;margin:0 0 10px;line-height:1.3;}
        .login-visual p{font-size:14px;opacity:.9;line-height:1.6;margin:0;}
        .fcard{
            position:relative;width:230px;height:140px;border-radius:14px;
            background:linear-gradient(135deg,#ffffff 0%,#dfe4ff 100%);
            box-shadow:0 16px 28px rgba(0,0,0,.25);
            padding:16px;color:var(--blue);
            display:flex;flex-direction:column;justify-content:space-between;
            align-self:center;margin:24px 0;
        }
        .fcard .chip{width:34px;height:24px;border-radius:5px;background:linear-gradient(135deg,#FFD98A,#F5A623);}
        .fcard .num{font-size:14px;letter-spacing:2px;font-weight:600;}
        .fcard .foot{display:flex;justify-content:space-between;align-items:flex-end;font-size:10px;font-weight:600;}
        .fcard .pts{background:var(--blue);color:var(--white);padding:3px 8px;border-radius:12px;font-size:10px;}
        .dots{display:flex;gap:6px;}
        .dots span{width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,.55);}
        .dots span:nth-child(2){background:rgba(255,255,255,.85);}

        .login-form{padding:48px 44px;display:flex;flex-direction:column;justify-content:center;}
        .login-form h1{font-size:24px;margin:0 0 6px;}
        .login-form .sub{font-size:13.5px;color:#5b5b66;margin:0 0 28px;}
        .field{margin-bottom:18px;}
        .field label{display:block;font-size:12.5px;font-weight:600;margin-bottom:6px;color:#33333d;}
        .field input{
            width:100%;padding:12px 14px;border-radius:8px;
            border:1.5px solid #e2e2ea;font-size:14px;font-family:'Inter',sans-serif;
            transition:.15s;
        }
        .field input:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px rgba(90,117,248,.15);}
        .row-between{display:flex;justify-content:space-between;align-items:center;margin:2px 0 24px;font-size:12.5px;}
        .forgot{color:var(--red);font-weight:600;text-decoration:none;}
        .forgot:hover{text-decoration:underline;}
        .btn-primary{
            width:100%;padding:13px;border:none;border-radius:8px;
            background:var(--blue);color:var(--white);font-weight:600;font-size:14.5px;
            box-shadow:0 8px 18px rgba(90,117,248,.35);
            transition:.15s;
        }
        .btn-primary:hover{background:#4661e0;}
        .login-error{
            display:none;background:#FFF0F0;border:1px solid var(--red);color:var(--red);
            font-size:12.5px;padding:9px 12px;border-radius:8px;margin-bottom:16px;
        }
        .login-footer{
            text-align:center;padding:16px;color:var(--white);font-size:12px;opacity:.85;
        }

        .enterprise_name{
            color: #4761D8;
            font-size: 25px;
        }

        /* ---------- MAIN APP ---------- */
        #page-main{display:none;min-height:100vh;flex-direction:column;}
        .app-body{display:flex;flex:1;min-height:0;}

        .sidebar{
            width:250px;flex-shrink:0;background:var(--sidebar-bg);
            color:var(--white);padding:22px 0;
            display:flex;flex-direction:column;
        }
        .menu-title{
            font-size:12px;letter-spacing:1.5px;font-weight:700;
            color:rgba(255,255,255,.65);padding:0 22px 14px;
        }
        .menu-list{list-style:none;margin:0;padding:0;}
        .menu-list li a{
            display:flex;align-items:center;gap:11px;
            padding:11px 22px;color:var(--white);text-decoration:none;
            font-size:13.5px;font-weight:500;border-left:3px solid transparent;
            transition:.15s;
        }
        .menu-list li a:hover{background:var(--sidebar-hover);}
        .menu-list li a.active{background:rgba(255,255,255,.14);border-left-color:var(--white);font-weight:600;}
        .menu-list li a .ic{width:17px;height:17px;flex-shrink:0;opacity:.9;}

        .main-content{flex:1;padding:32px 36px;overflow-y:auto;background:#F3F4FB;}
        .content-header{margin-bottom:26px;}
        .content-header h1{font-size:22px;margin:0 0 6px;color:var(--black);}
        .content-header p{margin:0;color:#5b5b66;font-size:14px;max-width:620px;line-height:1.6;}

        .stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px;}
        .stat-card{
            background:var(--white);border-radius:12px;padding:18px 20px;
            box-shadow:0 4px 14px rgba(20,20,50,.06);
        }
        .stat-card .label{font-size:12px;color:#7a7a86;font-weight:600;margin-bottom:8px;}
        .stat-card .value{font-size:24px;font-weight:700;color:var(--blue);}
        .stat-card .value.red{color:var(--red);}

        .panel{
            background:var(--white);border-radius:12px;padding:22px 24px;
            box-shadow:0 4px 14px rgba(20,20,50,.06);margin-bottom:22px;
        }
        .panel h3{margin:0 0 6px;font-size:16px;}
        .panel p{margin:0;color:#5b5b66;font-size:13.5px;line-height:1.7;}

        .footer{
            text-align:center;padding:14px;background:var(--white);
            color:#7a7a86;font-size:12px;border-top:1px solid #ececf3;
        }

        @media (max-width:880px){
            .login-grid{grid-template-columns:1fr;}
            .login-visual{display:none;}
            .stat-grid{grid-template-columns:repeat(2,1fr);}
        }
        @media (max-width:640px){
            .sidebar{position:fixed;left:-260px;top:0;bottom:0;z-index:40;transition:.2s;}
            .sidebar.open{left:0;}
            .main-content{padding:22px 16px;}
            .stat-grid{grid-template-columns:1fr;}
        }

        /*list-group-item-action:hover{
            background:#4661e0;
            color: white;
        }
        list-group-item-action:active{
            background:#4661e0;
            color: white;
        }
        .menu-list.list-group-item-action{
            border-bottom: 1px #0a53be solid;
        }*/

    </style>
    <link href="{{ asset('css/application-layout.css') }}" rel="stylesheet">
</head>
<body style="font-size: initial; font-family: Sora, sans-serif, Inter, sans serif;">
<div id="app">

    <?php
    if (Auth::guard('client')->check()) {
        $notifications0 = Notification:: where('recipient_address', Auth::guard('client')->user()->telephone)->where('read', false)->get();
        $notifications = [];
        foreach ($notifications0 as $notification){
            array_push($notifications, $notification);
        }

        if(Auth::guard('client')->user()->email != null){
            $notifications1 = Notification::
            where('recipient_address', Auth::guard('client')->user()->email)->orWhere('recipient_address', Auth::guard('client')->user()->email)->where('read', false)->get();
            foreach ($notifications1 as $notification){
                array_push($notifications, $notification);
            }
        }

        //$birthdate = (Auth::guard('client')->user()->birthdate != null) ? Carbon::parse(Auth::guard('client')->user()->birthdate)
        $incompleteProfile = false;
        if(Auth::guard('client')->user()->email == null
            || Auth::guard('client')->user()->birthdate == null
            || Auth::guard('client')->user()->gender == null
            || Auth::guard('client')->user()->quarter == null
            || Auth::guard('client')->user()->city == null){
            $incompleteProfile = true;
        }
        $incompleteProfileMsg = 'Les donnees suivantes sont a completer: ';
        if (Auth::guard('client')->user()->email == null){
            $incompleteProfileMsg .= __('Email');
        }
        if (Auth::guard('client')->user()->birthdate == null){
            $incompleteProfileMsg .= ', ' . __("Date de naissance (Jour et Mois)");
        }
        if (Auth::guard('client')->user()->gender == null){
            $incompleteProfileMsg .= ', ' . __('Sexe');
        }
        if (Auth::guard('client')->user()->quarter == null){
            $incompleteProfileMsg .= ', ' . __('Lieu de résidence');
        }
        if (Auth::guard('client')->user()->city == null){
            $incompleteProfileMsg .= ', ' . __('Ville');
        }
        $unreadMsgNum = count($notifications);

        $loyaltyaccount =  Loyaltyaccount::where('holderid', Auth::guard('client')->user()->id)->first();
    }
    ?>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top topbar">
        <div class="container">
            <a class="navbar-brand brand" href="{{ url('/') }}">
                @if(count(Config::all()) > 0)
                    @php
                        $config = Config::where('is_applicable', true)->first();
                    @endphp
                    @if($config != null)
                        <img src="{{asset('storage/' . $config->enterprise_logo)}}"
                             height="70" width="300"
                             alt="">
                        {{--<img src="{{asset('storage/' .$config->enterprise_logo)}}"
                             style="margin-top: -20px; margin-bottom: -20px; border-radius: 50%;" height="65" width="65"
                             alt=""> &nbsp;
                        &nbsp;<strong>{{ $config->enterprise_name }}</strong>--}}
                    @else
                        {{--<img src="{{asset('images/logo.png')}}"
                             style="margin-top: -20px; margin-bottom: -20px; border-radius: 50%;"
                             height="65"
                             width="65" alt=""> &nbsp; &nbsp;<strong>{{ config('app.name', 'Laravel') }}</strong>--}}
                        <img src="{{asset('images/logo.jpeg')}}"
                             height="70" width="300"
                             alt="">
                    @endif

                @else
                    {{--<img src="{{asset('images/logo.png')}}"
                         style="margin-top: -20px; margin-bottom: -20px; border-radius: 50%;" height="65"
                         width="65" alt=""> &nbsp; &nbsp;<strong>{{ config('app.name', 'Laravel') }}</strong>--}}
                    <img src="{{asset('images/logo.jpeg')}}"
                         height="70" width="300"
                         alt="">
                @endif

                <span class="enterprise_name">
                    @php
                        $config = Config::where('is_applicable', true)->first();
                    @endphp
                            @if($config != null && $config->enterprise_name)
                                &nbsp;  {{$config->enterprise_name}}
                            @endif
                </span>

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @if(Auth::guard('client')->check())
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            {{--<a class="list-group-item list-group-item-action nav-link"
                               href="{{ route('clients.notifs.index', Auth::guard('client')->user()->id) }}"
                               style="font-size: initial; display: inline;">
                               --}}{{--data-bs-toggle="modal" data-bs-target="#notifications-modal"--}}{{--
                                {{ __('Notifications') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="badge bg-success position-absolute top|start-*"
                                      style="
                                            position: relative;
                                            right: 0;
                                            border-radius: 50%;
                                            line-height: 20px;
                                            display: inline-block;
                                            text-align: center;
                                            margin-top: -10px;"
                                >{{$unreadMsgNum}}</span>
                            </a>--}}

                            @if($incompleteProfile)
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a  class="" href="{{ route('clients.form.update.client', Auth::guard('client')->user()->id)}}" style="display: inline;" title="{{$incompleteProfileMsg}}">
                                    <img src="{{asset('images/icons8-error-36.png')}}" alt="!" height="25" width="25">
                                </a>
                            @endif

                            {{--<div class="modal fade modal-lg" id="notifications-modal" data-bs-backdrop="static"
                                 data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                     style="overflow-y: initial; width: 75%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel"
                                                style="border: 0 red solid; width: 100%;">
                                                <strong
                                                    style="color: darkred;">{{'Notifications'}}</strong>
                                                <span style="
                                            position:relative;
                                            right: 0;
                                            float: right;
                                            color: darkred;
                                            font-size: x-large;"><strong>{{$unreadMsgNum}}</strong></span>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        --}}{{--<form method="POST" action="{{route('configuration.post')}}"
                                              enctype="multipart/form-data" onsubmit="return true;" >--}}{{--
                                        --}}{{--<div class="modal-body" style="height: 80vh; overflow-y: auto;">

                                            <input type="hidden" name="error" id="error"
                                                   class="form-control @error('error') is-invalid @enderror">
                                            @error('error')
                                            <span class="invalid-feedback" role="alert"
                                                  style="position: relative; width: 100%; text-align: center;">
                                                                    <strong>{{ $message }}</strong>
                                                                </span> <br/>
                                            @enderror

                                            @csrf

                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="list-group list-group-flush">
                                                        @foreach($notifications as $notification)
                                                            <adiv class="list-group-item list-group-item-action">
                                                                <h5>
                                                                    Objet: <strong>{{$notification->subject}}</strong>
                                                                    &nbsp; &nbsp;
                                                                    <span
                                                                        class="badge bg-primary position-absolute top|start-*"
                                                                        style="position: relative; right: 0; font-size: small;">
                                                        @php
                                                            $sent_at = Carbon::parse($notification->sent_at);
                                                        @endphp
                                                        Le: {{$sent_at->day . '-' . $sent_at->month . '-' . $sent_at->year . ' a ' . $sent_at->hour . ':' . $sent_at->minute . ':' . $sent_at->second}}
                                                        </span>
                                                                </h5>
                                                                <h5 style="font-size: small;">
                                                                    De: {{$notification->sender}}
                                                                    <a href="{{route('notifications.index', $notification->id)}}"
                                                                       style="position: relative; right: 0; float:right; text-decoration: none; margin-top: 5px;">
                                                                        {{'Details'}}
                                                                    </a>
                                                                </h5>
                                                                --}}{{----}}{{--<br><br>--}}{{----}}{{--
                                                            </adiv>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>--}}{{--
                                    </div>
                                </div>
                            </div>--}}
                        </li>
                    </ul>
                @endif

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        @include('layouts.language-switcher')

                    </li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    {{--@guest--}}
                    {{--@if (Route::has('enregistrement'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('enregistrement') }}">{{ __('Register') }}</a>
                        </li>
                    @endif--}}
                    {{-- @else--}}

                    @if(Auth::guard('client')->user() != null)
                            <?php

                            $client = Auth::guard('client')->user();
                            $loyaltyaccount = Loyaltyaccount::where('holderid', $client->id)->first();

                            ?>
                        <li>
                            <button class="btn btn-primary" style="
                            background-color:white;
                            font-family: 'DejaVu Sans Condensed';
                            border: #164fa9;
                            color: #164fa9;
                            ">
                                <strong
                                    style="
                                    font-weight: bold;
                                    font-size: 1.7em;
                                    color: #164fa9;
                                    ">{{__('Solde Fidélité')}}: {{decrypt($loyaltyaccount->point_balance)}} points
                                </strong>
                            </button>

                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <strong>{{ Auth::guard('client')->user()->name }}</strong>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end account-menu" aria-labelledby="navbarDropdown"
                                 >

                                <a class="dropdown-item"
                                   href="{{ route('clients.form.update.client', Auth::guard('client')->user()->id)}}">
                                    <strong>{{__('Mes Paramètres')}}</strong>
                                </a>
                                <a class="dropdown-item" href="{{ url('/'.GuestController::getApplicationLocal().'/password-reset-client')}}">
                                    <strong>{{__("Modifier mot de passe")}}</strong>
                                </a>

                                <a class="dropdown-item" href="{{ route('deconnexion') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('deconnexion-client-form').submit();">
                                    <strong>{{__("Déconnexion")}}</strong>
                                </a>

                                <form id="deconnexion-client-form" action="{{ route('deconnexion.client') }}"
                                      method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endif
                    {{--@endguest--}}
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>


    <footer class="login-footer">
        <div class="container text-center">
            <span class="text-white">
               Copyright &#169; LOFOMBO  {{Carbon::now()->year}}
                {{--<img src="{{asset('images/logo.jpeg')}}"
                     height="50" width="250"
                     alt="">--}}

            </span>
        </div>
    </footer>
</div>
</body>
</html>
