@extends('public.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12 col-lg-17">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ajout des joueurs</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="p-5">

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
                                                @foreach ($teams as $team)
                                                     <option  value="{{$team->id}}">{{$team->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                            <label >Mot de passe</label>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control " id="password" name="password" placeholder="Mot de passe" onkeyup="checkPass(); return false;">

                                            <span id='message' class="mt-3"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control " id="c_password" name="c_password" placeholder="Confimer le mot de passe" onkeyup="checkPass(); return false;">

                                        </div>

                                    </div>
                                    <div class="form-group">
                                    </div>
                                    <a type="button" id="saveUsers" onclick="saveUsers()" class="btn btn-primary">
                                        Enregistrer
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection