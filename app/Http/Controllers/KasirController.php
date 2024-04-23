<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index() {
        return view('kasir.index');
    }

    public function pesan() {
        return view('kasir.pesan');
    }

    public function pembayaran() {
        return view('kasir.pesan');
    }
}
