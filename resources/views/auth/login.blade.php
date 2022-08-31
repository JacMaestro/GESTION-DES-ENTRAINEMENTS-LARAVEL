<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>{{ env('APP_NAME')}} - Connexion</title>
    <link rel="shortcut icon" class="ronded" href="{{ asset('assets/img/favicon-32x32.png') }}">

    @include('public.css')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mb-4">Bienvenue sur {{ env('APP_NAME')}} !</h1>
                                    </div>
                                    <form class="user" id="loginForm">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control " id="email" name="email" placeholder="Email" aria-describedby="emailHelp">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control " id="password" name="password" placeholder="Mot de passe">
                                        </div> 
                                        <a type="button" id="loginBtn" onclick="login()" class="btn btn-primary btn-user   btn-block">
                                            Se connecter
                                        </a>
                                    </form>
                                    <div class="text-center mt-3"> 
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="/register">Créer un compte !</a>
                                    </div>
                                    <hr> 
                                    <div class="text-center">
                                        <a class="small" href="/forgot">Vous avez oublié votre mot de passe ?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
       
<!-- Modal -->
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