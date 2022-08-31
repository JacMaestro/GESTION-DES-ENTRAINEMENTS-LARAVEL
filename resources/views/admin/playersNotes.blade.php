@extends('public.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12 col-lg-17">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un Entrainement</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="p-5">

                                <form class="user" id="createTraining">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="my-select">Equipes</label>
                                            <select id="my-select" class="form-control" name="team_id" id="team_id" onchange="getInfos()">
                                                <option  hidden>Choisir une équipe</option>
                                                @foreach ($teams as $team)
                                                    <option  value='{{$team->id}}'>{{$team->name}}</option>
                                                @endforeach
                                                
                                               
                                            </select>
                                        </div>
                                   
                                        <div class="col-sm-6">
                                            <label>Date d'Entrainement</label>
                                            <select id="my-select" class="form-control" name="trainings" id="trainings">
                                                
                                              
                                               
                                            </select>
                                        </div>
   
                                    </div>
                                    <a type="button" id="store_training" onclick="saveTraining()" class="btn btn-primary">
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