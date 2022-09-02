@extends('public.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12 col-lg-17">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Enregistrer une note</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="p-1">

                                <form class="user" id="playerNote">
                                    @csrf

                                    <div class="form-group row">

                                        <div class="row col-md-12">
                                            <div class="col">

                                                <label>Equipe concernée:</label>
                                                <select class="form-control" name="team_id" id="team_id_1" onchange="getInfosNote($(this).attr('id'))">
                                                    <option hidden>Choisissez une équipe</option>

                                                    @foreach ($teams as $team)
                                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row col-md-12">
                                            <div class="col mt-2">

                                                <label>Date d'entrainement:</label>
                                                <select class="form-control" name="training_id" id="training_id">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row col-md-12">
                                            <div class="col mt-2">

                                                <label>Jouers:</label>
                                                <select class="form-control" name="player_id" id="player_id">
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row col-md-12 mt-2">
                                            <div class="col mt-1">
                                                <label>Attitude/Comportement :</label>
                                                <input type="number" class="form-control form-control " id="note_1" name="note_1" placeholder="0 - 5" min="0" max="5">
                                            </div>
                                            <div class="col mt-1">
                                                <label>Investissement/Intensite :</label>
                                                <input type="number" class="form-control form-control " id="note_2" name="note_2" placeholder="0 - 5" min="0" max="5">
                                            </div>
                                            <div class="col mt-1">
                                                <label>Technique/Niveau :</label>
                                                <input type="number" class="form-control form-control " id="note_3" name="note_3" placeholder="0 - 5" min="0" max="5">
                                            </div>
                                        </div>


                                    </div>
                                    <a type="button" id="store_note" onclick="saveNotes()" class="btn btn-primary">
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
                    <h6 class="m-0 font-weight-bold text-primary">Liste des notes</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Equipes</th>
                                    <th>Nom</th>
                                    <th>Prénom(s)</th>
                                    <th>Entrainements</th> 
                                    <th>Moyenne</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($players as $key => $player)
                                    @if(sizeof($notes[$player->id]) != 0)    
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{ $notes[$player->id][0]->name}}</td>
                                            <td>{{ $player->lastname}}</td>
                                            <td>{{ $player->firstname}}</td>
                                            <td>
                                                @foreach($notes[$player->id] as $val)
                                                    <div class="m-1">{{ date('d-m-Y', strtotime($val->date_training))}}</div><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($notes[$player->id] as $val)
                                                    <div class="m-1">{{ $val->moy}}</div><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($notes[$player->id] as $val)
                                                    <a class="btn btn-secondary m-1 disabled" id="{{$val->grade_id}}" href=""> <i class="fa fa-edit"></i></a>
                                                <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
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