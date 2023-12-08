<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicModel;

class MusicController extends Controller
{
   public function addMusic($id,Request $request){
    $music=new MusicModel();
    $music->artist_id=$id;
    $music->title=$request->title;
    $music->album_name=$request->album_name;
    $music->genre=$request->genre;
    $music->save();
   
    if(!$id){
        return response()->json([
            'message'=>'artist not found',
            'status'=>'error'
        ]);
    }else{
        return response()->json([
            'message'=>'Music added successfully',
            'status'=>'success'
        ]);
    }

}

    public function getMusics($artist_id_from_frontend){
       $music=MusicModel::where('artist_id',$artist_id_from_frontend)->get();

        if(!$music){
            return response()->json([
                'message'=>'no songs',
                'status'=>'error'
            ]);
        }else{
            return response()->json([
                'message'=>'retrieved successfully',
                'status'=>'success',
                'data'=>$music
            ]);
        }
    }

    public function editMusic($id,Request $request){
        $music=MusicModel::find($id);
        $music->title=$request->title;
        $music->album_name=$request->album_name;
        $music->genre=$request->genre;
        $music->save();

        if(!$music){
            return response()->json([
                'message'=>'Music not found',
                'status'=>'error'
            ]);
        }else{
            return response()->json([
                'message'=>'Edited successfully',
                'status'=>'success'
            ]);
        }

    }
    
    public function getSingleMusic($id){
        $getMusicById=MusicModel::find($id);

        if(!$getMusicById){
            return response()->json([
                'message'=>'Music not found',
                'status'=>'error'
            ]);
        }else{
            return response()->json([
                'message'=>'Retrieved Successfully',
                'status'=>'success',
                'data'=>$getMusicById
            ]);
        }
    }

    public function deleteMusic($id){
        $music=MusicModel::find($id);

        if(!$music){
            return response()->json([
                'message'=>'music not found',
                'status'=>'error'
            ]);
        }else{

            $music->delete();

            return response()->json([
                'message'=>'Deleted successfully',
                'status'=>'success'
            ]);
        }
      

    }
   
}
