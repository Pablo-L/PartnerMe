<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index(){
        $groups = DB::table('groups')->paginate(20);
        return view('group.groups-list',['groups'=>$groups]);
    }

    public function edit($id){

    }

    public function delete($id){

    }

    public function detail($id){
        
    }
}
