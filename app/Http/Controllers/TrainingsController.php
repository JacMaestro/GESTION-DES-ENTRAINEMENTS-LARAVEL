<?php

namespace App\Http\Controllers;

use App\Trainings;
use Illuminate\Http\Request;

class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $teams=\DB::table('teams')
                  ->where('active_flag',1)
                  ->select('*')
                  ->get();
        return view('admin.newTraining', compact('teams'));
    }

       

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->start_Week) && empty($request->end_Week) && empty($request->date_training) && empty($request->team_id) && empty($request->start_Week)) {
            echo ("false|| Aucun champ n'est pas renseigné");
            exit;
        } else if (empty($request->start_Week)) {
            echo ("false|| Le début de la semaine n'est pas renseigné");
            exit;
        } else if (empty($request->end_Week)) {
            echo ("false|| La fin de la semaine n'est pas renseigné");
            exit;
        } else if (empty($request->date_training)) {
            echo ("false|| Veuillez renseigner la date d'entrainement");
            exit;
        } else if (strtotime($request->start_Week)>strtotime($request->end_Week)) {
            echo ("false|| Veuillez choisir des dates correcte");
            exit;
        }  else if (strtotime($request->end_Week)<strtotime($request->date_training) && strtotime($request->start_Week)>strtotime($request->date_training)) {
            echo ("false|| Cette date n'est n'est pas comprise dans la semainse notifié");
            exit;
        }  else if (empty($request->team_id)) {
            echo ("false|| Veuillez choisir l'équipe concerné");
            exit;
        } 
        //  dd($request);
        //
        $save = Trainings::create([
            'start_Week' => $request->start_Week,
            'end_Week' => $request->end_Week,
            'date_training' => $request->date_training,
            'team_id' => $request->team_id,
            'created_at' => date('Y-m-d H:s:i'),
        ]);
      
        if ($save) {

            echo ("true|| Entrainement");
            exit;

        } else {

            echo ("false|| Erreur");
            exit;

        }
    
    }
    public function createNotes($id)
    {
        //
        $players=\DB::table('players')
                    ->join('teams','teams.id','=','playersteams_id')
                    ->join('trainings','trainings.teams_id','=','teams.id')
                    ->select('*')
                    ->get();
        return view('admin.playersNotes', compact('players')); 
    }
    public function getInfos()
    {
        
        //
        $training=\DB::table('teams')
                  ->join('trainings','trainings.team_id','=','teams.id')
                  ->where('teams.id',request('team'))
                  ->select('*')
                  ->get();
                //   var_dump($training);
        echo json_encode($training); 
    }
    public function newNotes()
    {
        //
        // $training=\DB::table('teams')
        //           ->join('trainings','trainings.teams_id','=','teams.id')
        //           ->where('id',$id)
        //           ->select('*')
        //           ->first();

        $teams=\DB::table('teams')
                  ->where('active_flag',1)
                  ->select('*')
                  ->get();

        // $players=\DB::table('players')
        //          ->where('team_id',$teams->id)
        //          ->select('*')
        //          ->first();


        return view('admin.playersNotes',compact('teams')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function show(Trainings $trainings)
    {
        //
        
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainings $trainings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainings $trainings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trainings  $trainings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainings $trainings)
    {
        //
    }
}
