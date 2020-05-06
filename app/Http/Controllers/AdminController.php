<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index(){
        $users = User::select('name' , 'email', 'foto', 'adm', 'bloqueado')->paginate(10);

        return view('admin.index')->withUsers($users);
    }
}
