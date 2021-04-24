<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $menu = Menu::whereLetak(3)->get();
        return view('backend.home', compact('menu'));
    }
}
