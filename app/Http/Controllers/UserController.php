<?php
namespace App\Http\Controllers;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function showAllUsers(){
        return response()->json(User::all());
    }
    public function getUser($id){
        return response()->json(User::find($id));
    }
    public function create(Request $request){
        $output=[];
        $code=200;
        try{
             // Validation
        $this->validate($request,[
            "name"=>"required|string",
            "phone"=>"required|unique:users",
            "username"=>"required|unique:users",
            "email"=>"required|email|unique:users",
            "password"=>"required"
        ]);
        // Insert to database
        $user=new User();
        $user->name=$request->input("name");
        $user->phone=$request->input("phone");
        $user->email=$request->input("email");
        $user->username=$request->input("username");
        $password=$request->input("name");
        $user->password=app('hash')->make($password);
        if($user->save()){
            $code=201;
            $output=[
                'status'=>200,
                'user'=>$user,
                'message'=>"User saved successfully."
            ];
        }else{
            $code=500;
            $output=[
                'status'=>500,
                'user'=>$user,
                'message'=>"An error occured while creating user. Please try again."
            ];
        }
       
        }catch(Exception $ex){
            dd($ex);
            $code=500;
            $output=[
                'status'=>500,
                'message'=>"An error occured while creating user. Please try again."
            ];
        }
       
        return response()->json($output, $code);
    }
    public function update($id, Request $request){
        // Validation
        $this->validate($request,[
            "name"=>"required",
            "phone"=>"required",
            "email"=>"required"
        ]);
        $user=User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }
    public function delete($id){
        User::findOrFail($id)->delete();
        return response("User Deleted!", 200);
    }
  
}
