<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ServiceLayer\RatingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;


class RatingController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function calculatePuntuations($id){
        $user = User::find($id);
        $puntuations = $user->received_ratings;
        
        $totalPuntuation = 0.0;

        foreach($puntuations as $puntuation){
            $totalPuntuation += $puntuation->points;
        }
        
        $averagePuntuation = ( $totalPuntuation / (count($puntuations) > 0 ? count($puntuations) : 1));        
        return $averagePuntuation;
    }

    public function detail($id){

        $user = User::find($id);
        
        /*Calculo las puntuaciones para no crear inconsistencia*/ 
        $puntuation = $this->calculatePuntuations($id);
        $user->puntuation = $puntuation;
        

        $ratings = $user->received_ratings;
        return view('rating.rating-page',[
            'user' => $user,
            'ratings' => $ratings
		]);
    }

    public function delete($creatorId, $receiverId,  $ratingId, Request $request){
        $receiver = RatingServices::deleteComment($creatorId, $receiverId,  $ratingId);
        if($receiver !== null){
            return redirect(route('user-rating', $receiver->id));
        }else{
            $request->session()->flash('error',  'No puede comentarse a sí mismo');
        }
    }

    public function upload(Request $request, $authUser = null){
        
        $request->validate([
            'points' => 'required|integer|between:0,10',
            'comment' => 'required',
        ]);
            
        $user = RatingServices::uploadComment($request, $authUser);
        
        if($user !== null){
            return redirect(route('user-rating', $user->id));
        }else{
            $request->session()->flash('error',  'No puede comentarse a sí mismo');
        }
      
    }


}
