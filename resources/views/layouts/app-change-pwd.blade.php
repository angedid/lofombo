@php
    use Illuminate\Support\Carbon;
 @endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
    </style>

</head>
<body style="font-size: initial; font-family: 'DejaVu Sans Light';">
<div id="app">
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
