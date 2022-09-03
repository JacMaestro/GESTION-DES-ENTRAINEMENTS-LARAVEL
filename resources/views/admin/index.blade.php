@extends('public.main')

@section('content')
<div id="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">

    @php if(session()->get('role') == 'admin') { @endphp
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Nombre de jouers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$nbr_player}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total d'entrainements</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$nbr_training}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-certificate fa-2x text-gray-300"></i>
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

        @php } else { @endphp

        @php } @endphp 


    </div>
    <!-- /.container-fluid -->

</div>


@endsection