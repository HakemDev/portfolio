<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Mail\ActivateYourAccount;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    { 
        
            $file=$data['file'];
            $imagename=time()."_".$file->getClientOriginalName();
            $imagename="image/portfolio/".$imagename;
            echo $imagename;
            
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'address' => $data['address'],
                'developer_type' => $data['developer_type'],
                'year_experience' => $data['year_experience'],
                'github_link' => $data['github_link'],
                'linekdin' => $data['linekdin'],
                'descritpion' => $data['description'],
                'about_me' => $imagename,
            ]);
        
    }

    /*
    * @param  \Illuminate\Http\Request  $request
    * @param  mixed  $user
    * @return mixed
    */
   protected function registered(Request $request, $user)
        {
            if($request->has('file'))
                    {
                        $file=$request->file('file');
                        $imagename=time()."_".$file->getClientOriginalName();
                        $file->move(public_path("/image/portfolio"),$imagename);
                        return redirect()->route('profil.user')->with([
                            'success'=>'you are connected'
                        ]); 
                      
                        
                    }
        }
}
