<?php

namespace App\Http\Controllers;

use App\Players;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        session()->forget('id');
        session()->flush();
        // dd(session()->get('id'));die;

        return redirect('/login');;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgot()
    {
        return view('auth.forgot');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addGamers()
    {
        return view('admin.addGamers');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listsUsers()
    {

        $users = DB::select('SELECT a.*, r.* FROM players a INNER JOIN roles r ON a.role_id = r.id ORDER BY a.id DESC ');

        return view('admin.listsUsers', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGames(Request $request)
    {

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */

        if (empty($request->firstname)) {
            echo ("false|| Veuillez entrer le nom");
            exit;
        } else if (empty($request->lastname)) {
            echo ("false|| Veuillez entrer le prenom");
            exit;
        } else if (empty($request->email)) {
            echo ("false|| Veuillez entrer l'email");
            exit;
        } else if (empty($request->phone)) {
            echo ("false|| Veuillez entrer le numéro de téléphone");
            exit;
        } else if (empty($request->teams)) {
            echo ("false|| Veuillez entrer l'équipe");
            exit;
        } else if (empty($request->c_password)) {
            echo ("false|| Veuillez entrer le mot de passe");
            exit;
        }
        $verify_user = DB::table('players')
            ->select('players.*')
            ->where('email', '=', $request->email)
            ->get();

        if (count($verify_user) == 1) {
            echo ("false|| Votre email est déjà utilisé");
            exit;
        } else {


            $users = Players::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->c_password),
                'active_flag' => 1,
                'team_id' => 1,
                'role_id' => 2
            ]);

            if ($users) {

                echo ("true|| La création du compte a été éffectué avec succès");
                exit;

            } else {

                echo ("false|| Une erreur s'est produite");
                exit;

            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Players  $players
     * @return \Illuminate\Http\Response
     */
    public function verifyLogin(Request $request)
    {
        if (empty($request->email)) {
            echo ("false|| Veuillez entrer votre email");
            exit;
        } else if (empty($request->password)) {
            echo ("false|| Veuillez entrer votre mot de passe");
            exit;
        }

        $email = $request->email;
        $password = $request->password;

        $model = Players::where('email', $email)->first();

        if ($model != null) {

            if (Hash::check($password, $model->password, [])) {
                if ($model->active_flag == 0) {
                    echo ("false|| Votre compte est en cours d'approbation");
                    exit;
                } else if ($model->active_flag == 2) {

                    echo ("false|| Votre compte a été rejeté");
                    exit;
                } else {

                    if ($model->role_id == 1) {

                        session()->put('id', $model->id);
                        session()->put('firstname', $model->firstname);
                        session()->put('lastname', $model->lastname);
                        session()->put('email', $model->email);
                        session()->put('role', 'admin');
                        session()->put('active_flag', $model->active_flag);
                        session()->save();

                        echo ("true||" . $model->role_id . "|| Connexion établie avec succès");
                        exit;
                    } else if ($model->role_id == 2) {
                        session()->put('id', $model->id);
                        session()->put('firstname', $model->firstname);
                        session()->put('lastname', $model->lastname);
                        session()->put('email', $model->email);
                        session()->put('role', 'player');
                        session()->put('active_flag', $model->active_flag);
                        session()->save();
                        echo ("true||" . $model->role_id . "|| Connexion établie avec succès");
                        exit;
                    }
                }
            } else {
                echo 'false|| Mot de passe incorrect';
                exit;
            }
        } else {
            echo 'false|| Cette adresse mail n\'existe pas dans notre base de données';
            exit;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Players  $players
     * @return \Illuminate\Http\Response
     */
    public function edit(Players $players)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Players  $players
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Players $players)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Players  $players
     * @return \Illuminate\Http\Response
     */
    public function destroy(Players $players)
    {
        //
    }
}
