<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Projet;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projets=Projet::all();
        $languages=Language::all();
        return view('home',compact('projets','languages'));
    
    }
    
    public function filter(Request $request){
        if(Str::contains($request->notauth,"notauth")){

            $user=User::where('id',$request->userId)->firstOrFail();
            $languages=Language::all();
            if(Str::contains($request->select_language, "all project")){
                $projets=$user->projets;
                
                return view('portfolio',compact('user'),compact('projets','languages'));
            }else{
                $language=Language::where('libelle','=',$request->select_language)->first();
                $projets=$language->projets()->where('user_id','=',$request->userId)->get();
                return view('portfolio',compact('user'),compact('projets','languages'));
            }
           

        }else{
            $languages=Language::all();
            if(Str::contains($request->select_language, "all project")){
                $projets=Projet::all();
                return view('home',compact('projets','languages'));
    
            }else{
                $language=Language::where('libelle','=',$request->select_language)->first();
                $projets=$language->projets()->get();
                return view('home',compact('projets','languages'));
            }
        }
        
    }

    public function profil(User $user)
        {
            
            $projets=$user->projets;
            $languages=Language::all();
            return view('portfolio',compact('user'),compact('projets','languages'));
        }
    public function logout(Request $request) {
        Auth::logout();

        return redirect('/home');
    }
}
