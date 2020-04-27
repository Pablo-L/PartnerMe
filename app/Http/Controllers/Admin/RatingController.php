<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function delete($creatorId, $receiverId,  $ratingId){
        //Elimino el rating del los ratings del creador
        $creator = User::find($creatorId);
        //$creator->created_ratings()->delete($ratingId);
        $creatorRatings = $creator->created_ratings;
        foreach($creatorRatings as $r){
            if($r->id == $ratingId){
                $r->delete();
            }
        }

        //Elimino el rating de los ratings recibidos por el receiver
        $receiver = User::find($receiverId);
        //$receiver->received_ratings()->delete($ratingId);
        $receivedRatings = $receiver->received_ratings;
        foreach($receivedRatings as $r){
            if($r->id == $ratingId){
                $r->delete();
            }
        }

        return redirect(route('admin.user-rating', $receiver->id));
    }

    public function upload(Request $request, $authUser = null){

        $validatedData = $request->validate([
            'points' => 'required|integer|between:0,10',
            'comment' => 'required',
        ]);

        $alias = $request->input('user_alias');
        $user = DB::table('users')->where('alias', $alias)->first();

        if($authUser && $authUser != $alias){

            $u = User::find($user->id);
            $u->received_ratings()->create([
                'user_id_creator' => $request->input('user_creator_id'),
                'user_id_receiver' => $request->input('user_receiver_id'),
                'points' =>  $request->input('points'),
                'comment' => $request->input('comment'),
            ]);
            $u->save();
    
            $puntuation = $this->calculatePuntuations($user->id);
            DB::table('users')->where('alias',$alias)->update(array(
                'puntuation'=>  number_format($puntuation, 2, '.', ''),
            ));
        }else{
            $request->session()->flash('error',  'No puede comentarse a sí mismo');
        }

        return redirect(route('admin.user-rating', $user->id));
    }


}
