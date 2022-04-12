<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
    {
        return view('plantFinder.plantFinder');
    }
    
}

