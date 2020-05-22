<?php

namespace App\ServiceLayer;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;


class RatingServices {
    public static function uploadComment(Request $request, $authUser) {
        
        $rollback = false;

        DB::beginTransaction();

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
            if(! $u->save()){
                $rollback = true;
            }
        
            $puntuation = app('App\Http\Controllers\RatingController')->calculatePuntuations($user->id);
            if(! DB::table('users')->where('alias',$alias)->update(array(
                'puntuation'=>  number_format($puntuation, 2, '.', ''),
            ))){
                $rollback = true;
            }
        }else{
            $rollback = true;
        }

        if ($rollback) {
            DB::rollBack();
            return null;
        }

        DB::commit();
        return $user;

    }

    public static function deleteComment($creatorId, $receiverId,  $ratingId){

        $rollback = false;

        DB::beginTransaction();

        //Elimino el rating del los ratings del creador
        $creator = User::find($creatorId);
        $creatorRatings = $creator->created_ratings;
        foreach($creatorRatings as $r){
            if($r->id == $ratingId){
                if(! $r->delete()){
                    $rollback = true;
                }
            }
        }

        //Elimino el rating de los ratings recibidos por el receiver
        $receiver = User::find($receiverId);
        $receivedRatings = $receiver->received_ratings;
        foreach($receivedRatings as $r){
            if($r->id == $ratingId){
                if(! $r->delete()){
                    $rollback = true;
                }
            }
        }

        if ($rollback) {
            DB::rollBack();
            return null;
        }

        DB::commit();
        return $receiver;

    }

}