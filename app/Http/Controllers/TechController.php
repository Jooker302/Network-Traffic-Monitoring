<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TechController extends Controller
{

    // Register New User
    public function register_user(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:users',
            'email'=>'required',
            'role'=>'required',
            'password'=>'required',
            'cpassword'=>'required|same:password'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->role=$request->role;
        $user->password=Hash::make($request->password);
        $result=$user->save();
        if($result)
        {
            return ['result'=>'User Successfully Registered.'];
        }
        else
        {
            return ['result'=>'Unable to Register User'];
        }
    }

    // Login Existing User
    public function user_login(Request $request)
    {
        $user=User::where('email',$request->email)->first();
        $role=User::where('role',$request->role)->first();
        if(!$user || !Hash::check($request->password,$user->password))
        {
            return response([
                'message'=>['These Credentials do not match to our record']
            ],404);
        }
        $token=$user->createToken("my-app-token")->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token,
            'role'=>$role
        ];
        return response($response,201);
    }

    //User Profile
    public function user_profile()
    {
        $userId=Auth::user()->id;
        $userData=User::where('id',$userId)->get();
        return response()->json([
            'status'=>200,
            'message'=>'User Profile',
            'data'=>$userData
        ]);
    }



    // Logout User
    public function user_logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message'=>'User Successfully Logged Out.'
        ],200);
    }
    
    
    public function all_users(){
        $user = User::where('role', '!=', 'admin')->get();
        $allusers = User::all();
        return response()->json([
            'status'=>200,
            'message'=>'Users',
            'nonAdminUsers'=>$user,
            'allUsers'=>$allusers,
        ]);
        
    }
    
    public function delete_user(Request $request){
        $user = User::where('id',$request->id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
            // 'data'=>$user
        ]);
        
    }
    
    public function update_user(Request $request){
        $user = User::where('id',$request->id)->first();
        $user->name=$request->name;
        $user->email=$request->email;
        // $user->role=$request->role;
        $user->password=Hash::make($request->password);
        $result=$user->save();
        return response()->json([
            'status'=>200,
            'message'=>'updated Successfully',
            'data'=>$user
        ]);
        
    }
    
    public function admin_add_user(Request $request){
        $request->validate([
            'name'=>'required|unique:users',
            'email'=>'required',
            'role'=>'required',
            'password'=>'required',
            'cpassword'=>'required|same:password'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->role=$request->role;
        $user->password=Hash::make($request->password);
        $result=$user->save();
        if($result)
        {
            return ['result'=>'User Successfully Registered.'];
        }
        else
        {
            return ['result'=>'Unable to Register User'];
        }
        
    }
    
    
    
}
