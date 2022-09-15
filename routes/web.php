<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Projet;
use App\Models\Language;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Str;

Auth::routes();

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/la',function(){
    return view('arabia');
});

Route::get('/projets',function(){
    $user=Projet::find(1);
    echo $user;                             
});
    
Route::get('/projets/insert',function(){
    $user=User::find(1);
    $projet=new Projet(['title'=>'projet2','description'=>'description projet2','github_link'=>'lin2','image'=>'img2']);
    $user->projets()->save($projet);
});

Route::get('/projets/read',function(){
    $user=User::find(1);
    echo $user;
    foreach($user->projets as $projet)
        {
             echo $projet->title."<br>";
        }
    $projet=new Projet(['title'=>'projet2','description'=>'description projet2','github_link'=>'lin2','image'=>'img2']);
    $user->projets()->save($projet);
});

Route::get('/projets/update',function(){
    $user=User::find(1);
    $user->projets()->whereId(1)->update(['title'=>'projet1_title','description'=>'description projet1','github_link'=>'lin1','image'=>'img1']);
    
});

Route::get('/language/projets',function(){
   $language=Language::where('libelle','=','aaaa')->firstOrFail();
   echo $language->projets();
});

Route::get('/language/projets/insert',function(){
    $language=Language::where('libelle','=','React Js')->firstOrFail();
    $projet=new Projet(['title'=>'etat civil','description'=>'description projet etat civil','github_link'=>'lin5','image'=>'img5','user_id'=>1]);
    $language->projets()->save($projet);
    //echo $language->projets();
 });

Auth::routes();


//add new project
Route::get('/projet/add',function(){
    /*$user=User::find(1);
    echo $user->role()->get();
    $user=Auth::user()->role->name;
    
    $bo= Str::of($user)->exactly('client');
    if($bo)
       {
        echo "gg";
       }*/
  return view('project.add');
 })->name('add.projet');
 /*
Route::get('/projet/indice',function(){
   /*$user=User::find(1);
    echo $user->role()->get();
    $user=Auth::user()->role->name;
    
    $bo= Str::of($user)->exactly('client');
    if($bo)
       {
        echo "gg";
       }
       return view('portfolio');
 });
*/

//call form to add new project
Route::get('/project/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
//add new projects to database
Route::post('/project/create', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');
//display my profil 
Route::get('/projet/profil/',[App\Http\Controllers\ProjectController::class, 'index'])->name('profil.user');
//display profil with filter for specific user
Route::post('/projet/filter/personnal',[App\Http\Controllers\ProjectController::class, 'filter'])->name('do.filter');
//delete a projet
Route::delete('/product/{id}',[App\Http\Controllers\ProjectController::class, 'delete'])->name('delete.projet');
//show update page
Route::get('/product/show/{id}',[App\Http\Controllers\ProjectController::class, 'show'])->name('upd.projet');
//update a project
Route::put('/product',[App\Http\Controllers\ProjectController::class, 'update'])->name('project.update');

//page home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//display profil wih filter for all projects
Route::post('/projet/filter/',[App\Http\Controllers\HomeController::class, 'filter'])->name('home.filter');

//display other person profil
Route::get('/profil/{user}',[App\Http\Controllers\HomeController::class, 'profil'])->name('profil');
//logout
Route::post('logout',[App\Http\Controllers\HomeController::class, 'logout'])->name('logout');

