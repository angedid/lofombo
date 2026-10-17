@php
    use App\Models\Client;
    use App\Models\FriendInvitatin;
    use App\Models\UserFirstTimeConnection;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Config;
    use App\Models\Notification;

    if (Auth::check()) {
        $notifications = Notification::where('sender_address', Auth::user()->email)->where('read', false)->orWhere('recipient_address', Auth::user()->email)->get();
        $unreadMsgNum = count($notifications);
        $userFirstTimeConnection = UserFirstTimeConnection::where('id', Auth::user()->id)->first();
    }
@endphp

<div class="col-md-3 sidebar">
    <div class="">
        <div class="menu-title">{{ __('Menu principal') }}</div>
        <div class="">
            <div class="list-group list-group-flush menu-list">

                <a class="list-group-item list-group-item-action btn btn-link"
                   href="{{ (Auth::check() && Auth::user()->is_admin) ? route('bi.menu') : route('simple.user.home')}}">
                    <h6><img src="{{asset('images/icons8-home-25.png')}}" alt=""> &nbsp;{{ __('Accueil') }}</h6>
                </a>

                @if(Auth::check() && Auth::user()->is_admin)

                    <a class="list-group-item list-group-item-action btn btn-link" href="{{route('configs.index')}}"
                       {{--data-bs-toggle="modal" data-bs-target="#system-config-modal"--}} id="lien-pour-configuration">
                        <h6><img src="{{asset('images/icons8-configuration-25.png')}}" alt="">
                            &nbsp;{{ __('Configuration Système') }}</h6>
                    </a>
                    @if(count(Config::where('is_applicable', true)->get()) === 0)
                        {{--{{count(Config::all())}}--}}
                        <script type="text/javascript">
                            var link = document.getElementById('lien-pour-configuration');
                            if (link) {
                                console.log(link.id);
                                var evt = new MouseEvent('click', {
                                    bubbles: true,
                                    cancelable: true,
                                    view: window
                                });
                                var ret = link.dispatchEvent(evt);
                                link.click();
                                console.log(ret);
                            }
                        </script>
                    @endif
                @endif
                @if(count(Client::all()) > 0)
                    <a class="list-group-item list-group-item-action btn btn-link"
                       href="{{ route('home.purchases.index')}}">
                        <h6><img src="{{asset('images/icons8-purchase-order-25.png')}}" alt="">
                            &nbsp;{{ __('Enregistrer un Achat') }}</h6>
                    </a>
                @endif
                @if(count(Config::where('is_applicable', true)->get()) > 0)
                    <a class="list-group-item list-group-item-action btn btn-link"
                       href="{{ route('home.clients-list')}}">
                        <h6><img src="{{asset('images/icons8-list-24.png')}}" alt=""> &nbsp;{{ __('Clients') }}</h6>
                    </a>
                @endif
                @if(count(Client::all()) > 0)
                    @if(count(\App\Models\Voucher::all()) > 0)
                        <a class="list-group-item list-group-item-action btn btn-link"
                           href="{{ route('clients.getVouchersAll.all')}}">
                            <h6><img src="{{asset('images/icons8-loyalty-card-25.png')}}" alt="">
                                &nbsp;{{ __('Bons de Fidélité') }}</h6>
                        </a>
                    @endif
                @endif
                @if(count(Config::where('is_applicable', true)->get()) > 0)
                    <a class="list-group-item list-group-item-action btn btn-link"
                       href="{{ route('rewards.index.list') }}">
                        <h6><img src="{{asset('images/icons8-reward-25.png')}}" alt=""> &nbsp;{{ __('Récompenses') }}
                        </h6>
                    </a>
                @endif

                <a class="list-group-item list-group-item-action btn btn-link"
                   href="{{route('home.loyaltytransactions.all')}}"
                   id="lien-pour-transaction-enregistres">
                    <h6>
                        <img src="{{asset('images/icons8-transaction-25.png')}}" alt=""> &nbsp;{{ __('Transactions') }}
                        <span class="badge bg-primary position-absolute top|start-*"
                              style="position: relative; right: 0; padding-top: 7px;">{{''}}</span>
                    </h6>
                </a>

                @if(Auth::check() && Auth::user()->is_admin)
                    <a class="list-group-item list-group-item-action btn btn-link"
                       href="{{ route('utilisateurs.admin')}}">
                        <h6><img src="{{asset('images/icons8-user-25.png')}}" alt=""> &nbsp;{{ __('Utilisateurs') }}
                        </h6>
                    </a>
                @endif

                @if(Auth::check() && Auth::user()->is_admin)
                    <a class="list-group-item list-group-item-action btn btn-link"
                       href="{{route('users.purchases-products.index')}}"
                       {{--data-bs-toggle="modal" data-bs-target="#system-products-modal"--}} id="lien-pour-produits-enregistres">
                        <h6><img src="{{asset('images/icons8-product-25.png')}}" alt="">
                            &nbsp;{{ __('Articles Enregistrés') }}</h6>
                    </a>
                @endif



                @if(Auth::check() && Auth::user()->is_admin)
                    <a class="list-group-item list-group-item-action btn btn-link"
                       href="{{route('home.reports')}}">
                        <h6><img src="{{asset('images/icons8-report-25.png')}}" alt="">
                            &nbsp;{{ __('Rapports') }}
                        </h6>
                    </a>
                @endif

                @if(Auth::check() && Auth::user()->is_admin)
                    <?php

                    $friendInvitationAccepteds = FriendInvitatin::where('state', FriendInvitatin::ACCEPTED)->get();
                    ?>
                    @if(count($friendInvitationAccepteds) > 0)
                        <a class="list-group-item list-group-item-action btn btn-link"
                           href="{{route('client.invitations.accepted.index')}}">
                            <h6><img src="{{asset('images/icons8-join-25.png')}}" alt="">
                                &nbsp;{{ __('Invitations') . ' ' .__('accepté') }}
                                <span class="badge bg-primary position-absolute top|start-*"
                                      style="position: relative; right: 0; padding-top: 7px; margin-top: 10px;">{{ count($friendInvitationAccepteds) }}</span>
                            </h6>
                        </a>
                    @endif

                    @if(Auth::check())
                        <a class="list-group-item list-group-item-action btn btn-link" href="{{route('notifs.index', Auth::user()->id)}}">
                            <h6><img src="{{asset('images/icons8-notification-25.png')}}" alt="">
                                &nbsp;{{ __('Notifications') }}
                                <span class="badge bg-primary position-absolute top|start-*"
                                      style="position: relative; right: 0; padding-top: 7px;">{{$unreadMsgNum}}</span></h6>
                        </a>
                    @endif

                    <a class="list-group-item list-group-item-action btn btn-link"
                       href="{{ route('send-bulk-message.admin')}}">
                        <h6><img src="{{asset('images/icons8-sent-25.png')}}" alt=""> &nbsp;{{ __('Message groupé') }}
                        </h6>
                    </a>
                @endif
                <a class="list-group-item list-group-item-action btn btn-link"
                   href="{{ route('contact-support')}}">
                    <h6><img src="{{asset('images/icons8-customer-support-25.png')}}" alt=""> &nbsp;{{ __('Contact Support') }}
                    </h6>
                </a>
            </div>
        </div>
    </div>
</div>


