@extends('public.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Entrainement</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="p-5">

                                <label>
                                    <strong class="">Définir la semaine d'entrainement</strong>
                                </label>
                                <form class="user" id="createWeek">
                                    @csrf
                                    <div class="form-group row">

                                        <div class="row col-md-12">
                                            <div class="col">

                                                <label>Equipe concernée:</label>
                                                <select id="my-select" class="form-control" name="team_id" id="team_id">
                                                    @foreach ($teams as $team)
                                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row col-md-12">
                                            <div class="col mt-2">

                                                <label>Libellé de la semaine:</label>
                                                <input type="text" class="form-control form-control " id="name" name="name" placeholder="">
                                            </div>
                                        </div>

                                        <div class="row col-md-12 mt-2">
                                            <div class="col">
                                                <label>Semaine Début:</label>
                                                <input type="date" class="form-control form-control " id="start_Week" name="start_Week" placeholder="">
                                            </div>
                                            <div class="col">
                                                <label>Fin Semaine:</label>
                                                <input type="date" class="form-control form-control " id="end_Week" name="end_Week">
                                            </div>
                                        </div>


                                    </div>
                                    <a type="button" id="store_week" onclick="saveWeek()" class="btn btn-primary">
                                        Enregistrer
                                    </a>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">

                                <label>
                                    <strong class="">Programmer un entrainement</strong>
                                </label>
                                <form class="user" id="createTraining">
                                    @csrf

                                    <div class="form-group row">

                                        <div class="row col-md-12">
                                            <div class="col">

                                                <label for="my-select">Equipes:</label>
                                                <select class="form-control" name="team_id" id="team_id" onchange="getInfos($(this).attr('id'))">
                                                    <option hidden>Choisir une équipe</option>
                                                    @foreach ($teams as $team)
                                                    <option value='{{$team->id}}'>{{$team->name}}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>

                                        <div class="row col-md-12 mt-2">
                                            <div class="col">
                                                <label>Semaine d'entrainement:</label>
                                                <select class="form-control" name="week_id" id="week_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row col-md-12 mt-2">
                                            <div class="col">
                                                <label>Choisissez un jour d'entrainement:</label>
                                                <input type="date" class="form-control form-control " id="date_training" name="date_training">
                                            </div>
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

    <div class="row">
        <div class="col-xl-12 col-lg-17">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des entrainements</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom de l'équipe</th>
                                    <th>Semaine</th>
                                    <th>Date d'entrainements</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trainings as $key => $training)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $training->team_name}}</td>
                                    <td>{{ $training->name}}</td>
                                    <td>{{ date('d-m-Y', strtotime($training->date_training)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection