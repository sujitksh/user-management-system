<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Mail\DemoMail;

class UserController extends Controller
{
  
    public function index(){
        return view('auth.login');
    }
    public function login(Request $req){

        $user = User::with(['getcountry','getstate','getcity'])->where('email',$req->email)->get();
        $data = $user[0];
           /* user valid then set session */
           if($data->password == md5($req->password)){
             $req->session()->put("uid",$data);
             return redirect("user/dashboard");
           }else{
               return redirect("/")->with("msg","Invalid credential");
           }
    }

    public function register(Request $req){
        /* handle here both HTTP method request POST+GET*/
        if($req->isMethod('post')){
            $res = $req->validate([
                "name"=>"required | string",
                "email"=>"required|email|unique:users",
                "password"=>"required|confirmed|min:6",
                "password_confirmation"=>"required",
                "dob"=>"required",
                "gender"=>"required",
                "country_id"=>"required",
                "state_id"=>"required",
                "city_id"=>"required"
            ],
            [
                "name.string"=>"Full name should be character",
                'email.email'=>"Please enter valid email",
                "email.unique"=>"This user already regiter use another email",
                "password.min"=>"Please enter minimum 6 character password",
            ]   /* putted here custom message for validation*/
        );
        
        User::create([
            "name"=>$req->name,
            "email"=>$req->email,
            "password"=>md5($req->password),
            "dob"=>$req->dob,
            "gender"=>$req->gender,
            "country_id"=>$req->country_id,
            "state_id"=>$req->state_id,
            "city_id"=>$req->city_id
        ]);

         /* mail sending functionality */
        $to = "sujitksh.kr00@gmail.com";
        $msg="This is user mail";
        $subject = "<b>Username: </b>$req->email <br><b>Password: </b>$req->password";
        //Mail::to($to)->send(new DemoMail($msg,$subject));
        return redirect()->route('user.register')->with('success', 'User successfully created!');
        }
        return view('auth.register');
    }

    public function dashboard(){
        return view("dashboard");
    }

    public function getCountry(){
        /* fetch all data from country table*/
          $data = Country::get();
          return response()->json(["data"=>$data]);
    }

    public function getState(Request $request){
            $id = $request->get('id');
           
         /* fetch the data based on state table field country_id*/
            $data = Country::withWhereHas('getstate',function($query) use($id){
                $query->where("country_id",$id);
            })->get();
            return response()->json(["data"=>$data]);
      
    }

    public function getCity(Request $request){
        $id = $request->get('id');
        /* fetch the data based on city table field state_id*/
        $data = State::withWhereHas('getcity',function($query) use($id){
            $query->where("state_id",$id);
        })->get();
        return response()->json(["data"=>$data]);
    }

    public function logout(Request $req){
        $req->session()->forget("uid");
        return redirect("/");
    }
}
