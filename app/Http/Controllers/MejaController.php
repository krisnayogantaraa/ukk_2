<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index() {
        return view('meja.index');
    }
}
