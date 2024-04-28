<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\logs;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\Registersusers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function akun(Request $request): View
    {


        if ($request->has('search')) {
            $users = User::where('name', 'LIKE', "%$request->search%")
                ->orWhere('email', 'LIKE', "%$request->search%")
                ->paginate(10);
        } else {
            $users = User::latest()->paginate(10);
        }

        //render view with users
        return view('admin.akun', compact('users'));
    }

    public function create(): View
    {
        return view('admin.create');
    }
    
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name'     => 'required|min:2|max:255',
            'email'     => 'required|min:5|max:255|unique:users',
            'password'    => 'required|min:8',
            'role_id'     => 'required|min:1|max:255',
        ]);

        //create User
        User::create([
            'name'      => $request->name,
            'role_id'      => $request->role_id,
            'email'      => $request->email,
            'password'      => bcrypt($request->password),
        ]);

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Membuat Akun Baru Bernama $request->name",
        ]);

        //redirect to index
        return redirect()->route('admin.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        //get User by ID
        $User = User::findOrFail($id);

        //render view with User
        return view('admin.edit', compact('User'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input
        $rules = [
            'name'     => 'required|min:2|max:255',
            'role_id'     => 'required|max:255',
            'email'    => 'required|min:5|max:255|unique:users,email,' . ($id ?? 'NULL'),
            'password' => 'nullable|min:8',
        ];

        if ($id) {
            // Jika ini adalah pembaruan, password menjadi opsional
            unset($rules['password']);
        }

        $request->validate($rules);

        // Ambil atau buat instance User sesuai dengan ID yang diberikan
        $user = $id ? User::findOrFail($id) : new User;

        // Isi data
        $user->name = $request->input('name');
        $user->role_id = $request->input('role_id');
        $user->email = $request->input('email');

        // Hash dan set password jika disediakan
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Simpan perubahan atau buat pengguna baru
        $user->save();

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Membuat Mengubah Akun dengan nama $request->name",
        ]);

        return redirect()->route('admin.index')->with('success', 'Data saved successfully');
    }

    public function logs(Request $request): View
    {

        if ($request->has('search')) {
            $logs = logs::where('nama_akun', 'LIKE', "%$request->search%")
                ->orWhere('aktivitas', 'LIKE', "%$request->search%")
                ->paginate(10);
        } else {
            $logs = logs::latest()->paginate(10);
        }

        //render view with logs
        return view('admin.logs', compact('logs'));
    }
}
