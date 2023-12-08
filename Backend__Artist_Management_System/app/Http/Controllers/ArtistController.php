<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArtistModel;

class ArtistController extends Controller
{
    public function registerArtist(Request $request){
       $artist=new ArtistModel();
       $artist->name= $request->name;
       $artist->dob=$request->dob;
       $artist->gender=$request->gender;
       $artist->address=$request->address;
       $artist->first_release_year=$request->first_release_year;
       $artist->no_of_albums_released=$request->no_of_albums_released;
       $artist->save();

       return response()->json([
        'message'=>'artist registered successfully',
        'status'=>'success',
        'data'=>$artist
       ]);



    }


    public function getAllArtist(){
        $allArtist=ArtistModel::all();
        return response()->json([
            'message'=>'artist retrieved successfully',
            'status'=>'success',
            'data'=>$allArtist
        ]);
    }


    public function getSingleArtist($id){
        $artist=ArtistModel::find($id);

        if(!$artist){
            return response()->json([
                'message'=>'Artist not found',
                'status'=>'error'
            ]);
        }else{
            return response()->json([
                'message'=>'Artist retrieved successfully',
                'status'=>'success',
                'data'=>$artist
            ]);
        }
    }

    public function editArtist($id,Request $request){   //for update
        $artist=ArtistModel::where('id',$id)->first();
        $artist->name=$request->name;
        $artist->dob=$request->dob;
        $artist->gender=$request->gender;
        $artist->address=$request->address;
        $artist->first_release_year=$request->first_release_year;
        $artist->no_of_albums_released=$request->no_of_albums_released;
        $artist->save();

        if(!$artist){
            return response()->json([
                'message'=>'artist not found',
                'status'=>'error'
            ]);
        }else{
            return response()->json([
                'message'=>'Edited Successfully',
                'status'=>'success'
            ]);
        }

    }

    public function deleteArtist($id){

        $artist=ArtistModel::find($id);

        if(!$artist){
            return response()->json([
                'message'=>'not found',
                'status'=>'error'
            ]);
        }else{

            $artist->delete();

            return response()->json([
                'message'=>'Deleted successfully',
                'status'=>'success'
            ]);
        }



    }


}
