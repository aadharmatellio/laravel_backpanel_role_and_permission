<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::where("status", "1")->count();
        return view('home.index', compact("users"));
    }
}
