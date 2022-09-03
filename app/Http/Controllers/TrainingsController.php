<?php

namespace App\Http\Controllers;

use App\Grades;
use App\Trainings;
use App\Weeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $teams=\DB::table('teams')
                  ->where('active_flag',1)
                  ->select('*')
                  ->get();
                  $training_count=\DB::table('trainings') 
                            ->select('*')
                            ->get();
                  $player_count=\DB::table('players')
                            ->where('role_id',2)
                            ->select('*')
                            ->get();

            $notes = array();
                  $players =\DB::table('players') 
                  ->select('players.*')
                  ->get();
                  foreach ($players as $key => $value) {
                    
                    
                    $grades=\DB::table('grades')
                    ->join('trainings','trainings.id','=','training_id')
                    ->join('players','players.id','=','player_id') 
                    ->join('teams','grades.team_id','=','teams.id') 
                    ->select('trainings.*','players.*','grades.*','grades.id as grade_id','teams.*')
                    ->where('players.id',$value->id)
                    ->get();

                     $notes[$value->id] = $grades;
                  }



                $nbr_player = count($player_count);
                $nbr_training = count($training_count);

        return view('admin.index',compact('teams','notes','players','nbr_player','nbr_training')); 
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

                  
                $trainings=\DB::table('trainings')
                ->join('weeks','trainings.week_id','=','weeks.id')
                ->join('teams','weeks.team_id','=','teams.id') 
                ->select('trainings.*','teams.*','teams.name as team_name','weeks.*')
                ->get();

                  $weeks=\DB::table('weeks') 
                            ->select('weeks.*')
                            ->get();

                            // dd($trainings);
        return view('admin.newTraining', compact('teams','trainings','weeks'));
    }

       

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTraining(Request $request)
    {

        if (empty($request->date_training)) {
            echo ("false|| La date d'entrainement n'est pas renseigné");
            exit;
        } else {
                 
            $date = date('Y-m-d', strtotime($request->date_training));
    
            $verify_training_week = DB::select("SELECT w.* FROM weeks w WHERE ('$date' BETWEEN w.start_Week AND w.end_Week)");

            if(sizeof($verify_training_week) == 0){ 
                echo ("false|| Cette date d'entrainement n'est pas dans la semaine choisie");
                exit;
            } else {
                    
                $save = Trainings::create([ 
                    'date_training' => $request->date_training,
                    'team_id' => $request->team_id,
                    'week_id' => $request->week_id
                ]); 

                if ($save) {
                    echo ("true|| Entrainement enregistré avec succès");
                    exit;
                } else{ 
                    echo ("false|| Une erreur s'est produite");
                    exit;
                }
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWeek(Request $request)
    {
        if (empty($request->name)) {
            echo ("false|| Veuillez entrer le libellé de la semaine");
            exit;
        } else if (empty($request->start_Week) && empty($request->end_Week)) {
            echo ("false|| Aucun champ n'a été renseigné");
            exit;
        } else if (empty($request->start_Week)) {
            echo ("false|| Le début de la semaine n'est pas renseigné");
            exit;
        } else if (empty($request->end_Week)) {
            echo ("false|| La fin de la semaine n'est pas renseigné");
            exit;
        } else if (strtotime($request->start_Week)>strtotime($request->end_Week)) {
            echo ("false|| Veuillez choisir des dates correcte");
            exit;
        }  else if (empty($request->team_id)) {
            echo ("false|| Veuillez choisir l'équipe concerné");
            exit;
        } else {
            
            $save = Weeks::create([
                'name' => $request->name,
                'start_Week' => $request->start_Week,
                'end_Week' => $request->end_Week, 
                'team_id' => $request->team_id
            ]); 

            if ($save) {
                echo ("true|| La semaine a été enregistrée avec succès");
                exit;
            } else{ 
                echo ("false|| Une erreur s'est produite");
                exit;
            }
        }

    }
    public function storeNotes(Request $request)
    {
        if (empty($request->team_id) && empty($request->training_id) && empty($request->player_id) && empty($request->note_1) && empty($request->note_2) && empty($request->note_3)) {
            echo ("false|| Aucun champ n'est pas renseigné");
            exit;
        } else if (empty($request->team_id)) {
            echo ("false|| Veuillez renseigner l'équipe");
            exit;
        } else if (empty($request->training_id)) {
            echo ("false|| Veuillez renseigner la date de l'entrainement");
            exit;
        } else if (empty($request->player_id)) {
            echo ("false|| Veuillez renseigner le joueur");
            exit;
        } else if (empty($request->note_1)) {
            echo ("false|| Veuillez renseigner le joueur");
            exit;
        }else if (empty($request->note_2)) {
            echo ("false|| Veuillez renseigner le joueur");
            exit;
        }else if (empty($request->note_3)) {
            echo ("false|| Veuillez renseigner le joueur");
            exit;
        } else {

            $verify_note_week = DB::select("SELECT g.* FROM grades g WHERE (g.team_id = '$request->team_id' AND g.player_id = '$request->player_id' AND g.training_id = '$request->training_id')");

            if(sizeof($verify_note_week) == 1){

                echo ("false||Une note a été attribuée à cet entrainement pour ce joueur");
                exit;
            } else {
                    
                $tab=[$request->note_1,$request->note_2,$request->note_3];

                $add=array_sum($tab);
                
                $moy=$add/3;

                $save = Grades::create([
                    'team_id' => $request->team_id,
                    'training_id' => $request->training_id,
                    'player_id' => $request->player_id,
                    'note_1' => $request->note_1,
                    'note_2' => $request->note_2,
                    'note_3' => $request->note_3,
                    'moy' => $moy
                ]);
            
                // dd($save);
                if ($save) {

                    echo ("true|| Note enregistré avec succès");
                    exit;

                } else {

                    echo ("false|| Une erreur s'est produite");
                    exit;

                }
            }
            
        }
        //  dd($request);
    
    }
  
    public function getInfos()
    {
        
        $weeks=\DB::table('weeks') 
                  ->where('weeks.team_id',request('team'))
                  ->select('weeks.*')
                  ->get();
                   
        $output = "<option  hidden> Choisir une semaine</option>";

        foreach ($weeks as $key => $value) {
                    
            $output .='<option value="'.$value->id.'">'.$value->start_Week.' à '.$value->end_Week.'</option>';
                    
        }


        echo json_encode($output); 
    }
    public function getInfos2()
    {
        
        $trainings=\DB::table('trainings') 
                  ->where('trainings.team_id',request('team'))
                  ->select('trainings.*')
                  ->get();
                   
        $output = "<option  hidden> Choisir une date d'entrainement </option>";
        // dd($trainings);
        foreach ($trainings as $key => $value) {
                    
            $output .='<option value="'.$value->id.'">'. date('d-m-Y', strtotime($value->date_training)).'</option>';
                    
        } 

        echo json_encode($output); 
    }
    public function getInfos3()
    {
        
        $players=\DB::table('players') 
                  ->where([['players.team_id',request('team')],['players.role_id',2]])
                  ->select('players.*')
                  ->get();
                   
        $output = "<option  hidden> Choisir un joueur </option>";
        // dd($trainings);
        foreach ($players as $key => $value) {
                    
            $output .='<option value="'.$value->id.'">'. $value->firstname .' '. $value->lastname.'</option>';
                    
        } 

        echo json_encode($output); 
    }
    public function playerInfos()
    {
        
        $training=\DB::table('trainings')
                  ->where('id',request('training'))
                  ->select('trainings.*')
                  ->first();
        //
        $players=\DB::table('players')
                 ->where('team_id',$training->team_id)
                 ->where('role_id',2)
                 ->select('players.*')
                 ->get();   
 
        $output ='';
        $output .='<option  hidden> Choisir un joueur</option>';


            foreach ($players as $player) {
                $grades=\DB::table('grades')
                ->join('trainings','trainings.id','=','training_id')
                ->join('players','players.id','=','player_id')
                ->where('player_id',$player->id)
                ->where('training_id',$training->id)
                ->select('trainings.*','players.*','grades.*')
                ->get();
                if(sizeof($grades) == 0){
                    
                    $output .='<option value="'.$player->id.'">'.$player->firstname.' '.$player->lastname.'</option>';
                    // echo
                }
                

            }
                  
// dd($output);die;
                
         echo json_encode($output); 
    }
    public function newNotes()
    {
       
        $teams=\DB::table('teams')
                  ->where('active_flag',1)
                  ->select('*')
                  ->get();

            $notes = array();
                  $players =\DB::table('players') 
                  ->select('players.*')
                  ->get();
                  foreach ($players as $key => $value) {
                    
                    
                    $grades=\DB::table('grades')
                    ->join('trainings','trainings.id','=','training_id')
                    ->join('players','players.id','=','player_id') 
                    ->join('teams','grades.team_id','=','teams.id') 
                    ->select('trainings.*','players.*','grades.*','grades.id as grade_id','teams.*')
                    ->where('players.id',$value->id)
                    ->get();

                     $notes[$value->id] = $grades;
                  }



                // dd($notes);

        return view('admin.playersNotes',compact('teams','notes','players')); 
    }
    public function viewNotes()
    {
       
        $teams=\DB::table('teams')
                  ->where('active_flag',1)
                  ->select('*')
                  ->get();


        return view('admin.viewNotes',compact('teams')); 
    }
    public function pNotes()
    {
          $output='';
        $output.='<div class="table-responsive" > 
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Prénoms</th>';
        
        // $players=\DB::table('players')
        //     ->where('team_id',request('team'))
        //     ->where('role_id',2)
        //     ->select('players.*')
        //     ->get();

        // foreach ($players as $player) {
        //     $notes=\DB::table('grades')
        //                 ->join('trainings','trainings.id','=','training_id')
        //                 ->join('players','players.id','=','player_id')
        //                 ->where('player_id',$player->id)
        //                 ->select('note')
        //                 ->get();           
        //     $tab=[];
        //     if(sizeof($notes)>=2){
                
        //           $add= array_sum($notes);
        //           $div=sizeof($notes);
        //           $evaluate=$add/$div;
        //         }


                
        //     }




        $trainings=\DB::table('trainings')
                  ->join('teams','teams.id','=','trainings.team_id')
                  ->where('teams.id',request('team'))
                  ->select('trainings.*')
                  ->get();
                  
      

                  foreach($trainings as $training){
                    $grades=\DB::table('grades')
                        ->join('trainings','trainings.id','=','training_id')
                        ->join('players','players.id','=','player_id')
                        ->where('training_id',$training->id)
                        ->select('trainings.*','players.*','grades.*')
                        ->get();
                        
                        if(sizeof($grades)==0){
                            
                                       $output.='<th>'.$training->date_training.'</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr> 
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>'; 
                        }else{
                            $output.=' <th>'.$training->date_training.'</th>
                                    </tr>
                                </thead>
                            <tbody>';
                                foreach ($grades as $grade) {
                                    $output.='
                                            <tr>
                                                
                                                    <td>'.$grade->firstname.'</td>
                                                    <td>'.$grade->lastname.'</td>
                                                    <td>'.$grade->note.'</td>
                                                </tr>';    
                                            }
                                            
                                        }
                                    $output .= '   </tbody>
                                    </table>
                                </div>';
                        }

                        

                    
    echo json_encode($output);
         
    }
    public function showEvaluatePage()
    {
       
        $teams=\DB::table('teams')
                  ->where('active_flag',1)
                  ->select('*')
                  ->get();
        return view('admin.playersNotes',compact('teams')); 
    }
    // public function evaluate()
    // {
    //     $moyenne=
    //     $players=\DB::table('players')
    //     ->where('team_id',request('team'))
    //     ->where('role_id',2)
    //     ->select('players.*')
    //     ->get(); 
    //     foreach($players as $player){
    //         $grades=\DB::table('grades')
    //                     ->join('players','players.id','=','player_id')
    //                     ->where('player_id',$player->id)
    //                     ->whereBetween('date_training', [$, $])
    //                     ->select('players.*','grades.*')
    //                     ->get();
    //                     if(sizeof($grades)>=2)
    //         foreach ($grades as $grade) {
    //             # code...
    //         }
    //     }
        
    //     return view('admin.playersNotes',compact('teams')); 
    // }

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
