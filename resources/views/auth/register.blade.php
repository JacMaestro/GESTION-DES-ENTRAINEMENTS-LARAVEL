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

                            <form class="user" id="saveGamersForm">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Prénom</label>
                                        <input type="text" class="form-control form-control " id="firstname" name="firstname" placeholder="">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Nom</label>
                                        <input type="text" class="form-control form-control " id="lastname" name="lastname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Numéro de téléphone</label>
                                        <input type="text" class="form-control form-control " id="phone" name="phone">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control form-control " id="email" name="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="my-select">Equipes</label>
                                        <select id="my-select" class="form-control" name="teams" id="teams">
                                            <option selected value="1">As Craponne</option>
                                        </select>
                                    </div>
                                </div>

                                <label>Mot de passe</label>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control " id="password" name="password" placeholder="Mot de passe" onkeyup="checkPass(); return false;">

                                        <span id='message' class="mt-3"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control " id="c_password" name="c_password" placeholder="Confimer le mot de passe" onkeyup="checkPass(); return false;">

                                    </div>

                                </div> 
                            <a type="button" id="saveUsers" onclick="createUser()" class="btn btn-primary btn-user   btn-block">
                                M'inscrire
                            </a>
                            </form>


                            <hr>
                            <div class="text-center">
                                <a class="small" href="/login">Vous avez déjà un compte ? Connectez-vous !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> 

    @include('public.js')


</body>

</html>