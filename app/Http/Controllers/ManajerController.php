<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Registersusers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManajerController extends Controller
{
    public function index()
    {
        return view('manajer.index');
    }

    public function menu(Request $request): View
    {


        if ($request->has('search')) {
            $menus = menu::where('nama', 'LIKE', "%$request->search%")
                ->orWhere('jenis', 'LIKE', "%$request->search%")
                ->orWhere('harga', 'LIKE', "%$request->search%")
                ->orWhere('foto', 'LIKE', "%$request->search%")
                ->paginate(10);
        } else {
            $menus = menu::latest()->paginate(10);
        }

        //render view with menus
        return view('manajer.menu', compact('menus'));
    }
}
