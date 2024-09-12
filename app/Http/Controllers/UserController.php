<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        /* check user email is valid or not*/
           $user = User::where('email',$req->email)->first();
           $data = compact("user");

           /* user valid then set session */
           if($user->password == md5($req->password)){
             $req->session()->put("uid",$user);
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
                "country"=>"required",
                "state"=>"required",
                "city"=>"required"
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
            "country"=>$req->country,
            "state"=>$req->state,
            "city"=>$req->city
        ]);

         /* mail sending functionality */
         $mailData = [
            'title'=>"Mail from admin",
            "body"=>"User Details: <br> <p>username: $req->email</p> <br> <p>username: $req->password</p>"
        ];
        Mail::to("sujitksh.kr00@gmail.com")->send(new DemoMail($mailData));
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

    public function getState($id){
         /* fetch the data based on state table field country_id*/
            $data = Country::withWhereHas('getstate',function($query){
                $query->where("country_id",$id);
            })->get();
            return response()->json(["data"=>$data]);
      
    }

    public function getCity($id){
        /* fetch the data based on city table field state_id*/
        $data = State::withWhereHas('getcity',function($query){
            $query->where("state_id",$id);
        })->get();
        return response()->json(["data"=>$data]);
    }

    public function logout(Request $req){
        $req->session()->forget("uid");
        return redirect("/");
    }
}
