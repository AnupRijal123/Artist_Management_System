<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;



class UserController extends Controller
{
    public function registerUser(Request $request){
            
        $checkEmail=UserModel::where('email',$request->email)->first();

        if($checkEmail){
            return response()->json([
                'message'=>'email already exists',
                'status'=>'error'
            ]);
        }else{
            $user=new UserModel();
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->phone=$request->phone;
            $user->dob=$request->dob;
            $user->gender=$request->gender;
            $user->address=$request->address;
            $user->save();

            return response()->json([
                'message'=>'Registration successfull',
                'status'=>'success'
            ]);

        }
        
        
       

    }


    public function loginUser(Request $request){
        $loginInfo=new UserModel();
        $loginInfo->email=$request->email;
        $loginInfo->password=$request->password;
        $checkUser=UserModel::where('email',$loginInfo->email)->first();

        if(empty($loginInfo->email) || empty($loginInfo->password)){
            return response()->json([
                'message'=>'email and password cannot be empty',
                'status'=>'error'
            ]);
        }

        if($checkUser){
            if(password_verify($request->password,$checkUser->password)){
                
                session(['user_id'=>$checkUser->id,'email'=>$checkUser->email]);

                return response()->json([
                    'message'=>'login successful',
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>'password didnt match',
                    'status'=> 'error'
                ]);
            }
                
        }
        else{
            return response()->json([
                'message'=>'Email not found',
                'status'=>'error'
            ]);
  
    }

}
public function getAllUsers(){
    $allUsers=UserModel::all();
    return response()->json([
        'message'=>'user retrieved successfuly',
        'data'=>$allUsers,
    ]);
  }

  public function getSingleUser($id){
    $getUserById=UserModel::find($id);

    if(!$getUserById){
        return response()->json([
            'message'=>'user not found',
            'status'=>'error'
        ]);
    }else{
        return response()->json([
            'message'=>'Retrieved successfully',
            'status'=>'success',
            'data'=>$getUserById
        ]);
    }

  }

  public function editUser($id,Request $request){
    $user=UserModel::find($id);
    $user->first_name=$request->first_name;
    $user->last_name=$request->last_name;
    $user->email=$request->email;
    $user->password=bcrypt($request->password);
    $user->phone=$request->phone;
    $user->dob=$request->dob;
    $user->gender=$request->gender;
    $user->address=$request->address;
    $user->save();

    if(!$user){
        return response()->json([
            'message'=>'user not found',
            'staus'=>'error'
        ]);

    }else{
        return response()->json([
            'message'=>'Edited successfully',
            'status'=>'success'
        ]);
    }

  }

  public function deleteUser($id){
    $user=UserModel::find($id);
    if(!$user){
        return response()->json([
            'message'=>'user not found',
            'staus'=>'error'
        ]);
    }else{

        $user->delete();

        return response()->json([
            'message'=>'deleted successfully',
            'status'=>'success'
        ]);

    }


  }

}
