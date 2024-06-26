<?php

namespace App\Http\Controllers;

use App\Models\carts;
use App\Models\menu;
use App\Models\user;
use App\Models\logs;
use App\Models\transactions;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use pdf;

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

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Menambakan menu ke keranjang",
        ]);
        return redirect()->back()->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function hapus_keranjang(Request $request): RedirectResponse
    {

        $id_menu = $request->id_menu;
        $cart = carts::where('id_menu', $id_menu)->first();

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Menghapus menu dari keranjang",
        ]);

        if ($cart) {
            $cart->delete();
            return redirect()->back()->with(['success' => 'Keranjang berhasil dihapus']);
        } else {
            return redirect()->back()->with(['error' => 'Keranjang tidak ditemukan']);
        }
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

        return view('kasir.keranjang', [
            'menus_with_jumlah_keranjang' => $menus_with_jumlah_keranjang,
        ], compact('total_item_keranjang', 'total_harga'));
    }

    public function store(Request $request): RedirectResponse
    {

        //validate form
        $this->validate($request, [
            'nama_kasir' => 'required',
            'no_meja' => 'required',
            'total_harga' => 'required',
            'total_bayar' => 'required',

        ]);

        //create
        transactions::create([
            'nama_kasir' => $request->nama_kasir,
            'no_meja' => $request->no_meja,
            'total_harga' => $request->total_harga,
            'total_bayar' => $request->total_bayar,

        ]);

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Memesan pesanan baru untuk meja no $request->no_meja",
        ]);

        //redirect to index
        return redirect()->route('cetak_invoice')->with('no_meja', $request->no_meja);
    }

    public function riwayat(Request $request): View
    {

        if ($request->has('search')) {
            $transactions = transactions::where('nama_kasir', 'LIKE', "%$request->search%")
                ->orWhere('no_meja', 'LIKE', "%$request->search%")
                ->orWhere('total_harga', 'LIKE', "%$request->search%")
                ->orWhere('total_bayar', 'LIKE', "%$request->search%")
                ->paginate(10);
        } else {
            $transactions = transactions::latest()->paginate(10);
        }


        return view('kasir.riwayat', compact('transactions'));
    }

    public function cetak_invoice(Request $request)
    {
        $no_meja = session('no_meja');
        $id_transaksi = session('id_transaksi');

        if (!empty($id_transaksi)) {
            $id_akun = user::where('name', $no_meja)->value('id');
        } else {
            $id_akun = auth()->id();
        }
        $name = Auth::user()->name;

        $carts_menu_ids = carts::where('id_akun', $id_akun)
            ->pluck('id_menu') // Mengambil ID menu dari carts
            ->toArray();

        $menus = menu::whereIn('id', $carts_menu_ids) // Hanya menu dengan ID yang ada di carts
            ->latest()
            ->get();
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

        $transaction = transactions::where('nama_kasir', $name)->first();

        carts::where('id_akun', $id_akun)->delete();

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Cetak Invoice untuk transaksi meja no $transaction->no_meja",
        ]);

        return view('kasir.invoice', [
            'menus_with_jumlah_keranjang' => $menus_with_jumlah_keranjang,
        ], compact('total_item_keranjang', 'total_harga', 'transaction', 'no_meja', 'id_transaksi'));
    }

    public function keranjang_meja($no_meja, $id_transaksi)
    {
        $user = user::where('name', $no_meja)->first();
        $transaction = transactions::where('no_meja', $no_meja)->first();

        $carts_menu_ids = carts::where('id_akun', $user->id)
            ->pluck('id_menu') // Mengambil ID menu dari carts
            ->toArray();

        $menus = menu::whereIn('id', $carts_menu_ids) // Hanya menu dengan ID yang ada di carts
            ->latest()
            ->get();

        $total_harga = 0;

        $jumlah_per_item = carts::selectRaw('id_menu, count(*) as jumlah')
            ->where('id_akun', $user->id)
            ->groupBy('id_menu')
            ->get();

        foreach ($jumlah_per_item as $item) {
            // Ambil harga menu dari tabel menus berdasarkan id_menu
            $menu = menu::find($item->id_menu);
            $total_harga += $menu->harga * $item->jumlah;
        }

        $menus_with_jumlah_keranjang = [];

        foreach ($menus as $menu) {
            $jumlah_keranjang = carts::where('id_akun', $user->id)
                ->where('id_menu', $menu->id)
                ->count();

            $menus_with_jumlah_keranjang[] = [
                'menu' => $menu,
                'jumlah_keranjang' => $jumlah_keranjang,
            ];
        }

        $total_item_keranjang = carts::where('id_akun', $user->id)
            ->count();

        return view('kasir.keranjang_meja', [
            'menus_with_jumlah_keranjang' => $menus_with_jumlah_keranjang,
        ], compact('total_item_keranjang', 'total_harga', 'no_meja', 'transaction','id_transaksi'));
    }

    public function meja_bayar(Request $request, $id_transaksi): RedirectResponse
    {

        //validate form
        $this->validate($request, [
            'nama_kasir' => 'required',
            'no_meja' => 'required',
            'total_harga' => 'required',
            'total_bayar' => 'required',

        ]);

        //create
        transactions::updateOrCreate(
            ['id' => $id_transaksi], // Kondisi pencarian
            [   // Data yang akan di-update atau dibuat
                'nama_kasir' => $request->nama_kasir,
                'no_meja' => $request->no_meja,
                'total_harga' => $request->total_harga,
                'total_bayar' => $request->total_bayar,
            ]
        );

        $name = Auth::user()->name;

        logs::create([
            'nama_akun' => $name,
            'aktivitas' => "Melakukan pembayaran untuk meja no $request->no_meja",
        ]);

        //redirect to index
        return redirect()->route('cetak_invoice')
            ->with('no_meja', $request->no_meja)
            ->with('id_transaksi', $id_transaksi);
    }
}
