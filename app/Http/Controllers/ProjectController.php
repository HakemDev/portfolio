<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;
use App\Models\Language;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Ui\Presets\React;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
        {
            $user=Auth::user();
            $id=$user->id;
            $projets=$user->projets;
            $languages=Language::all();
            return view('portfolio',compact('user'),compact('projets','languages'));
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages=Language::all();
        return view('project.add',compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request){
        $user=Auth::user();
        $id=$user->id;
        $languages=Language::all();
        if(Str::contains($request->select_language, "all project")){
            $projets=$user->projets;
            return view('portfolio',compact('user'),compact('projets','languages'));

        }else{
            $language=Language::where('libelle','=',$request->select_language)->first();
            $projets=$language->projets()->where('user_id','=',$id)->get();
            return view('portfolio',compact('user'),compact('projets','languages'));

        }
        

    }
    public function store(Request $request)
        {
            $id=Auth::user()->id;
            if($request->has('file'))
                    {
                        $file=$request->file('file');
                        $imagename=time()."_".$file->getClientOriginalName();
                        $file->move(public_path("/image/projet"),$imagename);
                        $imagename="image/projet/".$imagename;
                        
                        $projet=new Projet(['title'=>$request->title,
                        'description'=>$request->description,
                        'github_link'=>$request->github_link,
                        'image'=> $imagename,
                        'user_id'=> $id,
                        ]);
                        $projet->save();    
                        foreach($request->languages as $languag)   {
                            $language=Language::find($languag);
                            $language->projets()->save($projet);
                        }                     
                        return redirect()->route('profil.user')->with([
                            'success'=>'your project is added with success'
                        ]);
                    }
    
        
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projet=Projet::find($id);
        $languages=Language::all();
        return view('project.edit',compact("projet","languages"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
        {
            //supprimer tous les relation entre language et projet table
            $pro2=Projet::where('id',$request->id_proje)->firstOrFail();
            foreach($pro2->languages as $languag){
                $language=Language::find($languag->id);
                $language->projets()->detach($request->id_proje);

            }
                      
            if($request->has('file')){   
                $file=$request->file('file');
                $imagename=time()."_".$file->getClientOriginalName();
                $file->move(public_path("/image/projet"),$imagename);
                $imagename="image/projet/".$imagename;
                
                Projet::where('id',$request->id_proje)->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'github_link'=>$request->github_link,
                    'image'=>$imagename,
                ]);
                
                  

            }else{               
                Projet::where('id',$request->id_proje)->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'github_link'=>$request->github_link,
                    'image'=>$request->file2,
                ]);
            }
            //construire relation entre language et projet
            foreach($request->languages as $languag)   {
                $language=Language::find($languag);
                $language->projets()->attach($request->id_proje);
            } 
                       
            return redirect()->route('profil.user')->with([
                'success'=>'update operation is done'
            ]);        
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function delete($id)
    {
        $projet=Projet::findOrFail($id);
        $arr= $projet->languages()->get();
        foreach($arr as $val){
            $projet->languages()->detach($val->id);
        }
        $projet->delete();
        return redirect()->route('profil.user')->with(['success'=>" project $projet->title is deleted succeffully"]);
    }
}
