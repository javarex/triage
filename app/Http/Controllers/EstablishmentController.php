<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    public function create()
    {
        return view('establishment.create');
    }
}
