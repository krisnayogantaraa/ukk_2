<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('kasir.index', compact('menus'));
    }

    //
    /**
     * pesan
     *
     * @return View
     */
    public function pesan(Request $request): View
    {

        if ($request->has('search')) {
            $menus = menu::where('nama', 'LIKE', "%$request->search%")
                ->orWhere('harga', 'LIKE', "%$request->search%")
                ->get();
        } else {
            $menus = menu::latest()->get();
        }

        return view('kasir.pesan', compact('menus'));
    }

    public function pembayaran()
    {
        return view('kasir.pesan');
    }
}
