@extends('public.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">


        <div class="col-xl-12 col-md-3 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total des joueurs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($users)}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Liste des joueurs</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Numéro de téléphone</th>
                                    <th>Création</th>
                                    <!-- <th>Statut</th>  
                                    <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$user->firstname}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <!-- <td>
                                        @if($user->active_flag == 0)
                                        <span class="badge btn-danger">Non approuvé</span>
                                        @elseif ($user->active_flag == 2)

                                        <span class="badge btn-warning">Refusé</span>
                                        @else
                                        <span class="badge btn-success">Approuvé</span>

                                        @endif
                                    </td>  -->

                                    <!-- <td>

                                        @if($user->active_flag == 0)
                                        <a class="btn btn-success  ml-3 mr-3" onclick="enable($(this).attr('data-id'))" id="enableBtn" type="button" data-id="{{$user->id}}">
                                            <li class="fa fa-check"></li> Approuver
                                        </a>
                                        <a class="btn btn-primary  ml-3 mr-3" onclick="reject($(this).attr('data-id'))" id="rejectBtn" type="button" data-id="{{$user->id}}">
                                            <li class="fa fa-ban"></li> Rejeter
                                        </a>
                                        @elseif($user->active_flag == 2)
                                        <a class="btn btn-success  ml-3 mr-3" onclick="enable($(this).attr('data-id'))" id="enableBtn" type="button" data-id="{{$user->id}}">
                                            <li class="fa fa-check"></li> Approuver
                                        </a>
                                        @elseif($user->active_flag == 1)

                                        <a class="btn btn-danger ml-3 mr-3" onclick="disable($(this).attr('data-id'))" id="disableBtn" type="button" data-id="{{$user->id}}">
                                            <li class="fa fa-times"></li> Désactiver
                                        </a>
                                        @endif

                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row pb-5">

        <div class="col-md-12">
            <a href="/admin/addGamers" class="btn btn-primary float-left mb-2">Enregistrer un joueur</a> &nbsp; 
        </div>

    </div>
</div>

@endsection