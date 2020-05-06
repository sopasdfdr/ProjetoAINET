<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $users = DB::table('users')->select('name' , 'email', 'foto', 'adm', 'bloqueado')->paginate(20);




        return view('admin.index')
        ->withUsers($users);


    }
}
