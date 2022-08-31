<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Auto trading">
    <meta name="author" content="YoyoAutoTrading">

    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{ env('APP_NAME')}} - Enregistrement</title>
    <link rel="shortcut icon" class="ronded" href="{{ asset('assets/img/favicon-32x32.png') }}">

    @include('public.css')


</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h3 text-gray-900 mb-4">Créer un compte !</h1>
                            </div>
                            <form class="user" id="formCreateUser">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control " id="prenom" name="prenom" placeholder="Prénom">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control " id="nom" name="nom" placeholder="Nom">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control " id="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control " id="mot_de_passe" name="password" placeholder="Mot de passe" onkeyup="checkPass(); return false;">
                                        
                                    <span id='message' class="mt-3"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control " id="c_password" name="c_password" placeholder="Confimer le mot de passe" onkeyup="checkPass(); return false;">
                                        
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="cgu_terms" name="cgu_terms" checked="" style="width: 15px!important;">
                                        <label class="custom-control-label" for="cgu_terms">J'acceptes les conditions générales et termes d'utilisation.

                                        </label>
                                    </div>
                                </div>
                                <a type="button" id="saveUser" onclick="saveUser()" class="btn btn-primary btn-user  btn-block">
                                    M'inscrire
                                </a>
                            </form>
                                    <div class="text-center mt-3">
                                        <a type="button" class="btn btn-none" data-toggle="modal" data-target="#exampleModal">

                                            <i class="fas fa-fw fa-question-circle"></i>
                                            <span>Signaler un problème</span>

                                        </a>

                                        <!-- <a class="btn btn-none" href="{{route('register')}}">Signaler un problème</a> -->
                                    </div>
                                    <hr>
                            <div class="text-center">
                                <a class="small" href="{{route('index')}}">Vous avez déjà un compte ? Connectez-vous !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Centre d'aide</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="saveTicketForm">

                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Nom & Prénom (s)</label>
                            <input class="form-control" type="text" id="nom" name="nom" />
                        </div>
                        <div class="col-sm-6">
                            <label>Email</label>
                            <input class="form-control" type="email" id="email" name="email" required/>
                        </div>
                    </div>

                    <div class="form-group">
                    <label>Objet du ticket</label>

                    <input class="form-control" type="text" id="objet" name="objet" />
                                </div>



                    <label>Problème(s) rencontré(s)</label>
                    <input class="form-control" type="text" id="probleme" name="probleme" />

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button id="saveTicketBtn" type="button" onclick="saveTicket()" class="btn btn-primary">Soumettre</button>
            </div>
        </div>
    </div>
</div>



    @include('public.js')


</body>

</html>