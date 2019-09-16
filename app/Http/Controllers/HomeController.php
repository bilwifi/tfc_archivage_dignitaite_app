<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ListDignitairesDataTable;
use App\Http\Requests\AddDignitaireRequest;
use App\Models\Dignitaire;
use App\Models\Titre;
use Flashy;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('showDignitaire');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ListDignitairesDataTable $dataTable){
        return $dataTable->render('home');
    }

    public function showFormAddDignitaire(){
        return view('add_dignitaire');
    }

    public function addDignitaire(AddDignitaireRequest $request){
        // dd(request()->only('nom'));
        $dignitaire = Dignitaire::create(request()->all());
        $titre = Titre::updateOrCreate(
                                        [
                                            'iddignitaires' =>$dignitaire->iddignitaires,
                                            'idmedailles' =>request()->idmedailles,
                                        ],
                                        [
                                            'date_decoration'=>request()->date_decoration,
                                            'num_brevet'=>request()->num_brevet,
                                        ]);
        Flashy::message("$dignitaire->prenom $dignitaire->nom ajouté avec succès");
        return redirect()->route('edit_picture_user',$dignitaire->iddignitaires);
    }

    public function showDignitaire(Dignitaire $dignitaire){
        $titres = Titre::JoinMedaille()->where('iddignitaires',$dignitaire->iddignitaires)->get();
        return view('show_dignitaire',compact('dignitaire','titres'));
    }

    public function editPictureUser(Dignitaire $dignitaire){
        $dignitaire = $dignitaire;
        return view('upload_img',compact('dignitaire'));
    }

    public function addTitre(){
        $titre = Titre::updateOrCreate(request()->only('iddignitaires','idmedailles'),request()->only('date_decoration','num_brevet'));
        Flashy::message("Opération effectuée avec succcès");
        return redirect()->back();
    }

    /**
     * To handle the comming post request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImg(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|max:1000',
            'iddignitaires' => 'required|exists:dignitaires',
        ]);
        if ($validator->fails()) {
            
            return $validator->errors();            
        }


        $status = "";
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            // Rename image
            $filename = time().'.'.$image->guessExtension();
            
            $path = $request->file('profile_picture')->storeAs(
                 'profile_pictures', $filename
            );
            $dignitaire = dignitaire::find($request->iddignitaires);
            $dignitaire->picture = $path;
            $dignitaire->save();
            $status = "uploaded";            
        }
        
        return response($status,200);
    }
}
