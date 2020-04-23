<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;

class RatingController extends Controller{

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
        $user = DB::table('users')->where('id', $id)->first();
        $user = User::find($id);
        $puntuation = $this->calculatePuntuations($id);
        $user->puntuation = $puntuation;
        $ratings = $user->received_ratings;
        return view('rating.rating-page',[
            'user' => $user,
            'ratings' => $ratings
		]);
    }

    public function upload(Request $request){

        $validatedData = $request->validate([
            'points' => 'required|integer|between:0,10',
            'comment' => 'required',
        ]);


        $rating = DB::table('ratings')->insert(array(
            'user_id_creator' => $request->input('user_creator_id'),
            'user_id_receiver' => $request->input('user_receiver_id'),
            'points' =>  $request->input('points'),
            'comment' => $request->input('comment'),
        ));

        $alias = $request->input('user_alias');
        $user = DB::table('users')->where('alias', $alias)->first();
        $puntuation = $this->calculatePuntuations($user->id);
        DB::table('users')->where('alias',$alias)->update(array(
            'puntuation'=>  number_format($puntuation, 2, '.', ''),
        ));

        return redirect()->action('RatingController@detail', ['id' => $user->id]);
    }


}
