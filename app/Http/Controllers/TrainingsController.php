<?php

namespace App\Http\Controllers;

use App\Grades;
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
        $training=\DB::table('trainings')
                    ->where('start_Week',$request->start_Week)
                    ->where('end_Week',$request->end_Week)
                    ->where('team_id',$request->team_id)
                    ->select('trainings.*')
                    ->first();
        if(!$training){
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
            } else{ 
                echo ("false|| Erreur");
                exit;
            }
        }  else{ 
            echo ("false|| Cette semaine existe déjà");
            exit;
        }          
    }

    public function storeNotes(Request $request)
    {
        if (empty($request->team_id) && empty($request->trainings) && empty($request->selectPlayers)) {
            echo ("false|| Aucun champ n'est pas renseigné");
            exit;
        } else if (empty($request->team_id)) {
            echo ("false|| Veuillez renseigner l'équipe");
            exit;
        } else if (empty($request->trainings)) {
            echo ("false|| Veuillez renseigner l'entrainement");
            exit;
        } else if (empty($request->selectPlayers)) {
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
        }
        //  dd($request);
        $tab=[$request->note_1,$request->note_2,$request->note_3];
        $add=array_sum($tab);
        $note=$add/5;
        
        $save = Grades::create([
            'training_id' => $request->trainings,
            'player_id' => $request->selectPlayers,
            'note' => $note,
            'created_at' => date('Y-m-d H:s:i'),
        ]);
      
        if ($save) {

            echo ("true|| Enregistré");
            exit;

        } else {

            echo ("false|| Erreur");
            exit;

        }
    
    }
  
    public function getInfos()
    {
        
        $training=\DB::table('teams')
                  ->join('trainings','trainings.team_id','=','teams.id')
                  ->where('teams.id',request('team'))
                  ->select('trainings.*')
                  ->get();
                  
                //   dd($training);
        echo json_encode($training); 
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


        return view('admin.playersNotes',compact('teams')); 
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
