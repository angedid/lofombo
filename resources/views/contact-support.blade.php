@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(\Illuminate\Support\Facades\Auth::check())
                @include('layouts.menu')
            @else
                @if(\Illuminate\Support\Facades\Auth::guard('client')->check())
                    @include('layouts.client-menu')
                @endif
            @endif

            <div class="col-md-9">
                <div class="card" style="border: 0 red solid; padding: 0;">
                    <h4 class="card-header">{{__("Contactez-nous")}}</h4>
                    <br>
                    <div class="card-body" style="border: 0 red solid; margin: 0; padding: 0;">
                        <br>
                        <p style="font-size: 1.25em;">
                            <strong>{{__("Notre équipe est disponible pour répondre à toutes vos questions. Choisissez votre mode de contact ci-dessous.")}}</strong>
                        </p>
                        <br> <br>

                        <div class="row">
                            <br>
                            <div class="col col-md-6">
                                <h4>
                                    {{__("Vous avez une question ?")}}
                                </h4>
                                <p style="font-size: 1.25em;">
                                    {{__("Nous sommes là pour vous aider. Remplissez le formulaire ou contactez-nous par e-mail ou par téléphone.".
                                        "Notre service client est à votre disposition pour vous offrir la meilleure expérience possible avec LOFOMBO. ".
                                        "Si vous rencontrez un problème avec LOFOMBO, vous pouvez obtenir une solution personnalisée en nous contactant. ".
                                        "Nous sommes disponibles par e-mail 24h/24 et 7j/7, par téléphone de 8h à 20h du lundi au vendredi. Vous pouvez également".
                                        " nous retrouver sur les réseaux sociaux.")}}
                                </p>
                                <ol>
                                    <li>
                                        <h4>
                                            {{__("Téléphone")}}
                                        </h4>
                                        <ul style="font-size: 1.25em;">
                                            <li>(+237)691179154</li>
                                            <li>(+237)697392742</li>
                                            <li>(+237)695164930</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h4>
                                            {{__("Email")}}
                                        </h4>
                                        <ul style="font-size: 1.25em;">
                                            <li>support@lofombo.com</li>
                                            <li>lofombocm@gmail.com</li>
                                            <li>kanakemda@yahoo.com</li>
                                            <li>didnkallaehawe@gmail.com</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h4>
                                            {{__("Réseaux sociaux")}}
                                        </h4>
                                        <ul style="font-size: 1.25em;">
                                            <li>Facebook</li>
                                            <li>WhatsApp</li>
                                            <li>...</li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>
                            <div class="col col-md-6">

                                <div style="margin-left: 40px; margin-right: 20px; margin-top: -20px; padding: 20px; border: 3px #164fa9 solid; border-radius: 8px;">
                                    <form method="POST" action="{{route('contact-support.post')}}">
                                        <div><h6>{{__('Les champs marqués par ')}} <b class="" style="color: red;">*</b> {{__('sont obligatoires')}}</h6></div>
                                        <br>
                                        @csrf
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
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="name" style="margin-bottom: 7px;">{{__("Nom")}}&nbsp;<b class="" style="color: red;">*</b></label>
                                            <input name="name" type="text" class="form-control form-control @error('name') is-invalid @enderror" id="name" placeholder="{{__("Nom complet")}}" >
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="email" style="margin-bottom: 7px;">{{__("Email")}} &nbsp;<b class="" style="color: red;">*</b></label>
                                            <input name="email" type="email" class="form-control form-control @error('email') is-invalid @enderror" id="email" placeholder="{{__("")}}" >
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="phone" style="margin-bottom: 7px;">{{__("Numéro Tel")}}</label>
                                            <input name="phone" type="tel" class="form-control form-control @error('phone') is-invalid @enderror"
                                                   id="phone" placeholder="{{__("+237691179154")}}" onkeyup="removeNonNumericCharaters(this);">
                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="subject" style="margin-bottom: 7px;">{{__("Sujet")}}&nbsp;<b class="" style="color: red;">*</b></label>
                                            <input name="subject" type="text" class="form-control form-control @error('subject') is-invalid @enderror" id="subject" placeholder="{{__("")}}" >
                                            @error('subject')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label for="message" style="margin-bottom: 7px;">{{__("Message")}}&nbsp;<b class="" style="color: red;">*</b></label>
                                            <textarea name="message" class="form-control form-control @error('message') is-invalid @enderror" id="message"
                                                      placeholder="{{__("Messase")}}" rows="10"></textarea>
                                            @error('message')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group justify-content-center" style="margin-top: 15px; text-align: center;" >
                                            <button type="submit" class="btn btn-primary"><strong>{{__("Envoyer")}}</strong></button>
                                        </div>
                                    </form>
                                    <script type="text/javascript">
                                        function removeNonNumericCharaters(theInput){
                                            theInput.value = "+" + theInput.value.replace(/\D/g, '');
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>



                        <br><br><br><br><br><br><br><br><br><br><br>
                        <br><br><br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>

@endsection
