<?php

namespace App\Http\Controllers;

use App\Models\carts;
use App\Models\logs;
use App\Models\menu;
use App\Models\transactions;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use pdf;

class MejaController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $name = $user->name;

        $transaction = transactions::where(function ($query) use ($name) {
            $query->whereNull('nama_kasir')
                ->orWhere('nama_kasir', '')
                ->whereNull('total_bayar')
                ->orWhere('total_bayar', 0)
                ->where('no_meja', $name);
        })->first();

        if ($transaction) {
            $total_bayar = 1;
        } else {
            $total_bayar = 0;
        }

        return view('meja.index', compact('total_bayar'));
    }

    public function meja_pesan(Request $request): View
    {

        if ($request->has('search')) {
            $menus_makanan = menu::where(function ($query) use ($request) {
                $query->where('nama', 'LIKE', "%$request->search%")
                    ->orWhere('harga', 'LIKE', "%$request->search%");
            })
                ->where('jenis', '=', "Makanan")
                ->get();
            $menus_minuman = menu::where(function ($query) use ($request) {
                $query->where('nama', 'LIKE', "%$request->search%")
                    ->orWhere('harga', 'LIKE', "%$request->search%");
            })
                ->where('jenis', '=', "Minuman")
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
            'meja.pesan',
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

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Menambahkan menu ke keranjang dengan id $request->id_menu",
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
        
        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Menghapus menu dari keranjang dengan id $request->id_menu",
        ]);
    }

    public function keranjang()
    {
        $id_akun = Auth::id();

        $carts_menu_ids = carts::where('id_akun', $id_akun)
            ->pluck('id_menu') // Mengambil ID menu dari carts
            ->toArray();

        $menus = menu::whereIn('id', $carts_menu_ids) // Hanya menu dengan ID yang ada di carts
            ->latest()
            ->get();

        $id_akun = Auth::id(); // Variabel yang sudah Anda miliki
        $total_harga = 0;

        $jumlah_per_item = carts::selectRaw('id_menu, count(*) as jumlah')
            ->where('id_akun', $id_akun)
            ->groupBy('id_menu')
            ->get();

        foreach ($jumlah_per_item as $item) {
            // Ambil harga menu dari tabel menus berdasarkan id_menu
            $menu = menu::find($item->id_menu);
            $total_harga += $menu->harga * $item->jumlah;
        }

        $menus_with_jumlah_keranjang = [];

        foreach ($menus as $menu) {
            $jumlah_keranjang = carts::where('id_akun', $id_akun)
                ->where('id_menu', $menu->id)
                ->count();

            $menus_with_jumlah_keranjang[] = [
                'menu' => $menu,
                'jumlah_keranjang' => $jumlah_keranjang,
            ];
        }

        $total_item_keranjang = carts::where('id_akun', $id_akun)
            ->count();

        return view('meja.keranjang', [
            'menus_with_jumlah_keranjang' => $menus_with_jumlah_keranjang,
        ], compact('total_item_keranjang', 'total_harga'));
    }

    public function store(Request $request): RedirectResponse
    {
        $id_akun = Auth::id();

        //validate form
        $this->validate($request, [
            'no_meja' => 'required',
            'total_harga' => 'required',
        ]);

        //create
        transactions::create([
            'no_meja' => $request->no_meja,
            'total_harga' => $request->total_harga,
        ]);

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Menambahkan pesanan baru",
        ]);

        //redirect to index
        return redirect()->route('cetak_invoice');
    }

    public function batalkan_pesanan(Request $request): RedirectResponse
    {
        $user = Auth::user();
        carts::where('id_akun', $user->id)->delete();
        transactions::where('no_meja', $user->name)
        ->where('total_bayar', null)
        ->delete();

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Membatalkan pesanan",
        ]);

        //redirect to index
        return redirect()->route('meja.index');
    }
}
