<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Models\logs;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\Registersusers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function destroy($id): RedirectResponse
    {
        //get menu by ID
        $menu = menu::findOrFail($id);

        if ($menu->jenis == "Makanan") {
            Storage::disk('local')->delete('public/images/makanan/' . $menu->foto);
        } else {
            Storage::disk('local')->delete('public/images/minuman/' . $menu->foto);
        }

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Menghapus menu dengan nama $menu->nama",
        ]);

        //delete menu
        $menu->delete();

        //redirect to index
        return redirect()->route('menu')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function create(): View
    {
        return view('manajer.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama'     => 'required|min:5',
            'jenis'     => 'required|min:1',
            'harga'     => 'required|min:1',
            'foto'     => 'required|mimes:pdf,xlxs,xlx,docx,doc,csv,txt,png,gif,jpg,jpeg|max:2048',
        ]);

        if ($request->jenis == "Makanan") {
            $foto = $request->file('foto');
            $foto->storeAs('public/images/makanan', $foto->hashName());
        } else {
            $foto = $request->file('foto');
            $foto->storeAs('public/images/minuman', $foto->hashName());
        }


        menu::create([
            'foto'     => $foto->hashName(),
            'nama'      => $request->nama,
            'harga'      => $request->harga,
            'jenis'    => $request->jenis,
        ]);

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Menambah menu dengan nama $request->nama",
        ]);

        //redirect to index
        return redirect()->route('menu')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        //get menu by ID
        $menu = menu::findOrFail($id);

        //render view with menu
        return view('manajer.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'jenis' => 'required|string|in:Makanan,Minuman', // Validasi jenis menu
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Batasi jenis dan ukuran gambar
        ]);

        // Cari data menu yang akan diupdate berdasarkan ID
        $menu = Menu::findOrFail($id);

        // Update data menu dengan nilai baru dari form
        $menu->nama = $validatedData['nama'];
        $menu->harga = $validatedData['harga'];
        $menu->jenis = $validatedData['jenis'];

        // Tentukan path penyimpanan gambar berdasarkan jenis menu
        $pathPrefix = ($validatedData['jenis'] == 'Makanan') ? 'makanan' : 'minuman';

        // Proses gambar jika ada perubahan gambar baru yang diupload
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($menu->foto) {
                Storage::delete('public/images/' . $pathPrefix . '/' . $menu->foto);
            }

            // Simpan gambar baru ke direktori storage
            $foto = $request->file('foto');
            $path = $foto->storeAs('public/images/' . $pathPrefix, $foto->hashName());

            // Simpan nama file gambar baru ke database
            $menu->foto = basename($path);
        }

        // Simpan perubahan ke database
        $menu->save();

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Mengubah data menu dengan nama $request->nama",
        ]);

        // Redirect atau tampilkan pesan berhasil
        return redirect()->route('menu')->with('success', 'Data menu berhasil diperbarui.');
    }

    public function logs(Request $request): View
    {

        if ($request->has('search')) {
            $logs = logs::where('nama_akun', 'LIKE', "%$request->search%")
                ->orWhere('aktivitas', 'LIKE', "%$request->search%")
                ->latest()
                ->paginate(10);
        } else {
            $logs = logs::latest()->paginate(10);
        }

        //render view with logs
        return view('manajer.logs', compact('logs'));
    }
}
