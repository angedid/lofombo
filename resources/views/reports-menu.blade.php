@php
    use App\Models\Loyaltytransaction;
    use App\Models\Product;
    use App\Models\Client;
    use App\Models\Reward;
    use App\Models\Voucher;
    use App\Models\Purchase;
    use App\Models\Loyaltyaccount;
    use App\Models\Config;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @include('layouts.menu')

            <div class="col-md-9">
                <div class="card">
                    {{--<div class="card-header">

                    </div>--}}
                    <div class="card-body" >
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div>
                            <div
                                style="
                                text-align: center;
                                width: 100%;
                                font-size: 3em;
                                color: #164fa9;
                                font-weight: bold;
                                margin-top: 15px;
                                margin-bottom: 25px;
                                ">
                                <h2>{{__("Tableau de bord")}}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-4">
                                <button class="btn btn-danger btn-lg"
                                        style="width: 100%;" onclick="">
                                   <span style="color: white; font-size: xx-large;">
                                       {{__("Achats")}}
                                       <br>
                                       <strong>{{Purchase::count()}} ({{Purchase::sum('amount')}} {{isset($config) ? $config->currency_name : 'FCFA'}})</strong>
                                   </span>
                                </button>
                            </div>
                            <div class="col col-md-4">
                                <button class="btn btn-primary btn-lg"
                                        style="width: 100%;">
                                    <span style="color: white; font-size: xx-large;">
                                        {{__('Récompenses disponibles')}}
                                        <br>
                                        <strong>{{Reward::where('active', true)->count()}} ({{Reward::where('active', true)->sum('value')}} {{isset($config) ? $config->currency_name : 'FCFA'}})</strong>
                                   </span>
                                </button>
                            </div>

                            <div class="col col-md-4">
                                <button class="btn btn-success btn-lg"
                                        style="width: 100%;">
                                <span style="color: white; font-size: xx-large;">
                                   {{__('Bons de Fidélité Générés')}}
                                    <strong><br>{{Voucher::count()}}</strong>
                               </span>
                                </button>
                            </div>

                        </div>
                        <br>

                        <div class="row">
                            <div class="col col-md-4">
                                <button class="btn btn-info btn-lg"
                                        style="width: 100%;">
                                   <span style="color: white; font-size: x-large;">
                                       {{ __("Clients") }}
                                       <br><br>
                                       <strong>{{Client::count()}}</strong>
                                   </span>
                                </button>
                            </div>
                            <div class="col col-md-4">
                                <button class="btn btn-warning btn-lg"
                                        style="width: 100%;">
                                    <span style="color: black; font-size: x-large;">
                                        {{ __("Articles") }}
                                        <br><br>
                                        <strong>{{Product::count()}}</strong>
                                   </span>
                                </button>
                            </div>

                            <div class="col col-md-4">
                                <button class="btn btn-secondary btn-lg"
                                        style="width: 100%;">
                                <span style="color: white; font-size: x-large;">
                                   {{ __("Transactions") }}
                                    <br><strong>{{Loyaltytransaction::count()}}
                                        ({{Loyaltytransaction::sum('amount')}} {{isset($config) ? $config->currency_name : 'FCFA'}})</strong>
                               </span>
                                </button>
                            </div>

                        </div>

                        <br>

                        <div class="row">
                            <div class="col col-md-4">
                                <button class="btn btn-warning btn-lg"
                                        style="width: 100%;">
                               <span style="color: white; font-size: x-large;">
                                   {{ __("Bonus initial") }}
                                   <br><br>
                                   <?php
                                   $txs = Loyaltytransaction::where('gift_amount', '!=', 0)->get();
                                   $totalGiftPoint = 0;
                                   foreach ($txs as $tx){
                                       $conf = Config::where('id', $tx->configid)->first();
                                       $amount_per_point = $conf->amount_per_point;
                                       $totalGiftPoint += $tx->gift_amount / $amount_per_point;
                                   }
                                   ?>
                                   <strong>{{ $totalGiftPoint }} {{ $totalGiftPoint ==1 ? "point" : "points"}}</strong>
                               </span>
                                </button>
                            </div>
                            <div class="col col-md-4">
                                <button class="btn btn-info btn-lg"
                                        style="width: 100%;">
                                <span style="color: black; font-size: x-large;">
                                    {{ __("Bonus Anniversaire") }}
                                    <br><br>
                                    <?php
                                        $txs = Loyaltytransaction::where('transactiontype', 'ENREGISTREMENT ACHAT')->where('birthdate_amount', '!=', 0)->get();
                                        $totalPoint = 0;
                                        foreach ($txs as $tx){
                                            $conf = Config::where('id', $tx->configid)->first();

                                            $amount_per_point = $conf->amount_per_point;
                                            $totalPoint += $tx->birthdate_amount/$amount_per_point;
                                        }
                                    ?>
                                    <strong>{{ $totalPoint }} {{ $totalPoint ==1 ? "point" : "points" }}</strong>
                               </span>
                                </button>
                            </div>

                            {{--<div class="col col-md-4">
                                <button class="btn btn-secondary btn-lg"
                                        style="width: 100%;">
                            <span style="color: white; font-size: x-large;">
                               {{'Total des Transactions'}}
                                <br><strong>{{Loyaltytransaction::sum('amount')}} {{isset($config) ? $config->currency_name : 'FCFA'}}</strong>
                           </span>
                                </button>
                            </div>--}}

                        </div>
                        {{--<div class="row" style="border-bottom: 3px black solid; margin-top: 20px;">

                        </div>--}}
                        <br><br>

                            <div class="row">
                                <div class="col col-md-10 offset-1">
                                    <h4>{{__("Répartition des achats")}}</h4>
                                    <?php
                                        $maxPurchase = Purchase::max('amount');
                                        ?>
                                        @if($maxPurchase != null)
                                        <?php
                                            $firtInterval = Purchase::where('amount', '<', 0.25*$maxPurchase)->count();
                                        $secondInterval = Purchase::where('amount', '>=', 0.25*$maxPurchase)->where('amount', '<', 0.5*$maxPurchase)->count();
                                        $thirdInterval = Purchase::where('amount', '>=', 0.5*$maxPurchase)->where('amount', '<', 0.75*$maxPurchase)->count();
                                        $fourthInterval = Purchase::where('amount', '>=', 0.75*$maxPurchase)->where('amount', '<=', $maxPurchase)->count();

                                    /*$chartPurchase = Chartjs::build()
                                        ->name("RegisteredPurchases")
                                        ->type('bar')
                                        ->size(['width' => 400, 'height' => 200])
                                        ->labels([
                                            '[0, ' . intval(strval(0.25*$maxPurchase)) . '[' ,
                                            '['.intval(strval(0.25*$maxPurchase)) . ', ' . intval(strval(0.5*$maxPurchase)) . '[',
                                            '['.intval(strval(0.5*$maxPurchase)) . ', ' . intval(strval(0.75*$maxPurchase)) . '[',
                                            '['.intval(strval(0.75*$maxPurchase)) . ', ' . $maxPurchase . ']',
                                        ])
                                        ->datasets([
                                            [
                                                "label" => __("% max achat"),
                                                'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                                                'data' => [25, 50, 75, 100]
                                            ],
                                            [
                                                "label" => "Total des achats",
                                                'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
                                                'data' => [$firtInterval, $secondInterval, $thirdInterval, $fourthInterval]
                                            ]
                                        ])
                                        ->options([
                                            "scales" => [
                                                "y" => [
                                                    "beginAtZero" => true
                                                ]
                                            ]
                                        ]);*/

                                    $chartPurchase = Chartjs::build()
                                        ->name('barChartPurchases')
                                        ->type('bar')
                                        ->size(['width' => 600, 'height' => 400])
                                        ->labels([
                                                '[0, ' . intval(strval(0.25*$maxPurchase)) . '[' ,
                                                '['.intval(strval(0.25*$maxPurchase)) . ', ' . intval(strval(0.5*$maxPurchase)) . '[',
                                                '['.intval(strval(0.5*$maxPurchase)) . ', ' . intval(strval(0.75*$maxPurchase)) . '[',
                                                '['.intval(strval(0.75*$maxPurchase)) . ', ' . $maxPurchase . ']',
                                            ]
                                            /*['Label x', 'Label y']*/)
                                        ->datasets([
                                            [
                                                "label" => [
                                                    __("Nombre d'achats")
                                                    /*__("Achats")." < " . intval(strval(0.25*$maxPurchase)),
                                                    intval(strval(0.25*$maxPurchase)) . " <= Achat <" . intval(strval(0.5*$maxPurchase)),
                                                    intval(strval(0.5*$maxPurchase)) . " <= Achat <" . intval(strval(0.75*$maxPurchase)),
                                                    intval(strval(0.75*$maxPurchase)) . " <= Achat <=" . intval(strval($maxPurchase)),*/
                                                ] ,
                                                'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(0, 162, 0, 0.2)', 'rgba(0, 255, 255, 0.3)'],
                                                'data' => [$firtInterval, $secondInterval, $thirdInterval, $fourthInterval]
                                            ],
                                            /*[
                                                "label" => intval(strval(0.25*$maxPurchase)) . " <= Achat <" . intval(strval(0.5*$maxPurchase)),
                                                'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)', 'rgba(0, 162, 0, 0.2)', 'rgba(0, 255, 255, 0.3)'],
                                                'data' => [65, 75, 35, 63]
                                            ],
                                            [
                                                "label" => intval(strval(0.5*$maxPurchase)) . " <= Achat <" . intval(strval(0.75*$maxPurchase)),
                                                'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)', 'rgba(0, 162, 0, 0.2)', 'rgba(0, 255, 255, 0.3)'],
                                                'data' => [50, 80, 60, 28]
                                            ],
                                            [
                                                "label" => intval(strval(0.75*$maxPurchase)) . " <= Achat <=" . intval(strval($maxPurchase)),
                                                'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)', 'rgba(0, 162, 0, 0.2)', 'rgba(0, 255, 255, 0.3)'],
                                                'data' => [80, 25, 40, 72]
                                            ]*/
                                        ])
                                        ->options(/*[
                                            "scales" => [
                                                "y" => [
                                                    "beginAtZero" => true
                                                ]
                                            ]
                                        ]*/
                                            [
                                                'scales' => [
                                                    'yAxes' => [
                                                        [
                                                            'ticks' => [
                                                                'beginAtZero' => true,
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ]
                                        );

                                    //$clients = Client::where('active', $active)->whereBetween('created_at', [$from, $to])-> orderBy('created_at', 'desc')->get();

                                    ?>
                                    {{--<span>$maxPurchase = {{$maxPurchase}}</span>--}}
                                    <div style="width:100%;">
                                        <x-chartjs-component :chart="$chartPurchase" />
                                    </div>

                                        @else
                                            <span style="color: red;">{{__("Aucun achat enregistré")}}</span>
                                        @endif
                                        
                                </div>

                                <br>
                            </div>
                            <div class="row">
                                <div class="col col-md-10 offset-1">
                                    <br><br>
                                    <h4>{{__("Répartition des transactions")}}</h4>
                                    <?php
                                    $numTransactions = Loyaltytransaction::sum('point');
                                    $numTransactionInitialBonus = Loyaltytransaction::where('transactiontype', 'INITIALISATION COMPTE CLIENT')->sum('point');
                                    $numTransactionBirthdateBonus = Loyaltytransaction::where('transactiontype', 'ENREGISTREMENT ACHAT')->where('gift_amount', 0)->sum('point');
                                    $numTransactionAchats = Loyaltytransaction::where('transactiontype', 'ENREGISTREMENT ACHAT')->sum('point');
                                    $numTransactionGenVoucher = Loyaltytransaction::where('transactiontype', 'GENERATION DE BON')->sum('point');

                                    $other = $numTransactions - ($numTransactionInitialBonus + $numTransactionBirthdateBonus + $numTransactionAchats +
                                        $numTransactionGenVoucher);


                                    $chartTransactionsPoints = Chartjs::build()
                                        ->name('pieChartTxPoints')
                                        ->type('pie')
                                        ->size(['width' => 400, 'height' => 200])
                                        ->labels([__("Initialisation compte client"), __("Bonus Anniversaire"),
                                            __("Achats"), __("Génération de bon"), __("Autres")])
                                        ->datasets([
                                            [
                                                'backgroundColor' => ['#164FA9', '#36A2EB', '#C77120', '#FF00FF', '#66FFFF'],
                                                'hoverBackgroundColor' => ['#164FA9', '#36A2EB', '#C77120', '#FF00FF', '#66FFFF'],
                                                'data' => [$numTransactionInitialBonus, $numTransactionBirthdateBonus, $numTransactionAchats,
                                                    $numTransactionGenVoucher, $other]
                                            ]
                                        ])
                                        ->options([]);
                                    ?>

                                    <div style="width:100%;">
                                        <x-chartjs-component :chart="$chartTransactionsPoints" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <br><br>
                                    <h4>{{__("Répartition des récompenses")}}</h4>
                                    <?php
                                        $nbRewardProd = Reward::where('active', true)->where('nature', 'MATERIAL')->count();
                                        $nbRewardSer = Reward::where('active', true)->where('nature', 'SERVICE')->count();
                                        $nbRewardFinancial = Reward::where('active', true)->where('nature', 'FINANCIAL')->count();

                                    $chartReward = Chartjs::build()
                                        ->name('pieChartRewards')
                                        ->type('pie')
                                        ->size(['width' => 400, 'height' => 200])
                                        ->labels([__("Produit"), 'Service', __("Financière")])
                                        ->datasets([
                                            [
                                                'backgroundColor' => ['#164FA9', '#36A2EB', '#C77120'],
                                                'hoverBackgroundColor' => ['#164FA9', '#36A2EB', '#C77120'],
                                                'data' => [$nbRewardProd, $nbRewardSer, $nbRewardFinancial]
                                            ]
                                        ])
                                        ->options([]);

                                    ?>

                                    <div style="width:100%;">
                                        <x-chartjs-component :chart="$chartReward" />
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <br><br>
                                    <h4>{{__("Répartition des récompenses par type de bon")}}</h4>
                                    <?php
                                        $config = Config::where('is_applicable', true)->first();
                                        $niveaux = json_decode($config->levels);
                                        $rewards = Reward::where('active', true)->get();
                                        $levels = [];
                                        foreach ($niveaux as $n){
                                            $levels[$n->name] = 0;
                                        }
                                        foreach ($rewards as $reward){
                                            $level = $reward->level;
                                            $niveau = json_decode($level);
                                            $levelName = $niveau->name;
                                            if (isset($levels[$levelName])){
                                                $levels[$levelName] = $levels[$levelName] + 1;
                                            }else{
                                                $levels[$levelName] = 1;
                                            }
                                        }

                                        $keys = [];
                                        $values = [];
                                        $colors = [];
                                        foreach ($levels as $k => $v){
                                            $keys[] = $k;
                                            $values[] = $v;
                                            $colors[] = Reward::generate_random_hex_color();
                                        }

                                    $chartRewardVoucheType = Chartjs::build()
                                        ->name('pieChartRewardsPerLevels')
                                        ->type('pie')
                                        ->size(['width' => 400, 'height' => 200])
                                        ->labels($keys)
                                        ->datasets([
                                            [
                                                'backgroundColor' => $colors,
                                                'hoverBackgroundColor' => $colors,
                                                'data' => $values
                                            ]
                                        ])
                                        ->options([]);

                                    ?>

                                    <div style="width:100%;">
                                        <x-chartjs-component :chart="$chartRewardVoucheType" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col col-md-6">
                                    <br><br>
                                    <h4>{{__("Répartition des bons de fidélité par type")}}</h4>
                                    <?php
                                    $config = Config::where('is_applicable', true)->first();
                                    $niveaux = json_decode($config->levels);
                                    $keys = [];
                                    $values = [];
                                    $colors = [];
                                    foreach ($niveaux as $n){
                                        $val = Voucher::where('level', $n->name)->where('active', true)->count();
                                        $keys[] = $n->name;
                                        $values[] = $val;
                                        $colors[] = Reward::generate_random_hex_color();
                                    }

                                    $chartVoucher = Chartjs::build()
                                        ->name('pieChartVouchers')
                                        ->type('pie')
                                        ->size(['width' => 400, 'height' => 200])
                                        ->labels($keys)
                                        ->datasets([
                                            [
                                                'backgroundColor' => $colors,
                                                'hoverBackgroundColor' => $colors,
                                                'data' => $values
                                            ]
                                        ])
                                        ->options([]);
                                    ?>

                                    <div style="width:100%;">
                                        <x-chartjs-component :chart="$chartVoucher" />
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <br><br>
                                    <h4>{{__("Répartition des clients par enregistrement")}}</h4>
                                    <?php

                                        $numClients = Client::where('active', true)->count();
                                        $nimInvitedClient = Client::where('active', true)->where('was_invited', true)->count();


                                    $chartClients = Chartjs::build()
                                        ->name('pieChartClients')
                                        ->type('pie')
                                        ->size(['width' => 400, 'height' => 200])
                                        ->labels([__("Enregistrement Normal"), __("Enregistrement par Invitation")])
                                        ->datasets([
                                            [
                                                'backgroundColor' => ['#164FA9', '#36A2EB'],
                                                'hoverBackgroundColor' => ['#164FA9', '#36A2EB'],
                                                'data' => [$numClients - $nimInvitedClient, $nimInvitedClient]
                                            ]
                                        ])
                                        ->options([]);
                                    ?>

                                    <div style="width:100%;">
                                        <x-chartjs-component :chart="$chartClients" />
                                    </div>
                                </div>

                            </div>
                            <br>


                        {{--<div>
                            <?php

                            $chart = Chartjs::build()
                                ->name('Transactions')
                                ->type('pie')
                                ->size(['width' => 400, 'height' => 100])
                                ->labels(['Label x', 'Label y'])
                                ->datasets([
                                    [
                                        'backgroundColor' => ['#FF6384', '#36A2EB'],
                                        'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                                        'data' => [69, 59]
                                    ]
                                ])
                                ->options([]);

                           ?>

                            <div style="width:75%;">
                                <x-chartjs-component :chart="$chart" />
                            </div>

                        </div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

