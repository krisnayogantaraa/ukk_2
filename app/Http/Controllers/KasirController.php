<?php

namespace App\Http\Controllers;

use App\Models\carts;
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
        return view('kasir.index');
    }

    public function pesan(Request $request): View
    {

        if ($request->has('search')) {
            $menus_makanan = menu::where('nama', 'LIKE', "%$request->search%")
                ->orWhere('harga', 'LIKE', "%$request->search%")
                ->Where('jenis', '=', "Makanan")
                ->get();
            $menus_minuman = menu::where('nama', 'LIKE', "%$request->search%")
                ->orWhere('harga', 'LIKE', "%$request->search%")
                ->Where('jenis', '=', "Minuman")
                ->get();
        } else {
            $menus_makanan = menu::latest()
                ->Where('jenis', '=', "Makanan")
                ->get();
            $menus_minuman = menu::latest()
                ->Where('jenis', '=', "Minuman")
                ->get();
        }

        $id_akun = Auth::id();

        $menus_with_jumlah_keranjang_makanan = [];
        $menus_with_jumlah_keranjang_minuman = [];

        // Mengambil data menu makanan dan menghitung jumlah keranjang
        foreach ($menus_makanan as $menu_makanan) {
            $jumlah_keranjang = carts::where('id_akun', $id_akun)
                ->where('id_menu', $menu_makanan->id)
                ->count();

            $menus_with_jumlah_keranjang_makanan[] = [
                'menu' => $menu_makanan,
                'jumlah_keranjang' => $jumlah_keranjang,
            ];
        }

        // Mengambil data menu minuman dan menghitung jumlah keranjang
        foreach ($menus_minuman as $menu_minuman) {
            $jumlah_keranjang = carts::where('id_akun', $id_akun)
                ->where('id_menu', $menu_minuman->id)
                ->count();

            $menus_with_jumlah_keranjang_minuman[] = [
                'menu' => $menu_minuman,
                'jumlah_keranjang' => $jumlah_keranjang,
            ];
        }

        $total_item_keranjang = carts::where('id_akun', $id_akun)
        ->count();


        return view(
            'kasir.pesan',
            [
                'menus_with_jumlah_keranjang_makanan' => $menus_with_jumlah_keranjang_makanan,
                'menus_with_jumlah_keranjang_minuman' => $menus_with_jumlah_keranjang_minuman,
            ],
            compact('total_item_keranjang')
        );
    }

    public function tambah_keranjang(Request $request): RedirectResponse
    {
        $id_akun = Auth::id();
        carts::create([
            'id_akun' => $id_akun,
            'id_menu' => $request->id_menu,
        ]);

        return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function hapus_keranjang(Request $request): RedirectResponse
    {

        $id_menu = $request->id_menu;
        $cart = carts::where('id_menu', $id_menu)->first();
        if ($cart) {
            $cart->delete();
            return redirect()->back()->with(['success' => 'Keranjang berhasil dihapus']);
        } else {
            return redirect()->back()->with(['error' => 'Keranjang tidak ditemukan']);
        }
    }

    public function keranjang()
    {
        return view('kasir.keranjang');
    }

    public function pembayaran()
    {
        return view('kasir.pesan');
    }
}
