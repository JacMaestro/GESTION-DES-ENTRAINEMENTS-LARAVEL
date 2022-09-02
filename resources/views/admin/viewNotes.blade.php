@extends('public.main')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12 col-lg-17">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Consulter notes joueurs</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <form class="user" id="playerNote">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-6 mb-sm-0">
                                            <label for="my-select">Equipes :</label>
                                            <select class="form-control" name="team_id" id="team_id" onchange="getPnotes($(this).attr('id'))">
                                                <option hidden>Choisir une équipe</option>
                                                @foreach ($teams as $team)
                                                <option value='{{$team->id}}'>{{$team->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12 col-lg-17">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Liste des joueurs / Entrainement</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" id='tableaux'>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="row pb-5">



</div> 

@endsection