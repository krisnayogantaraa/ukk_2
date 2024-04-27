@extends('layouts.main')

@section('contents')

<div class="bg-bgutama" style="min-height:100vh;">
    <nav class=" bg-coklat border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo/logo.png') }}" class="h-16" alt="Logo Cafe" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Cafe Bisa Ngopi</span>
            </a>
            <div class="flex h-14 gap-4">
                <p class="text-white align-middle mt-3 text-2xl">Keranjang</p>
            </div>
            <div class="flex h-14 gap-4">
                <p class="text-white align-middle mt-3 text-lg">{{ Auth::user()->name }}</p>
                <div class="h-14 w-14 bg-white rounded-full">

                </div>
            </div>
        </div>
    </nav>
    <div class="p-16 px-24 pb-3">
        <div class="w-24 pt-3 ml-3 mb-2">
            <a href="/riwayat" class="flex gap-2">
                <svg style="margin-top: 3px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 270 223" fill="none">
                    <path d="M79.6313 143.023L16.2396 79.6313M16.2396 79.6313L79.6313 16.2396M16.2396 79.6313H190.567C207.379 79.6313 223.503 86.3101 235.392 98.1983C247.28 110.087 253.959 126.211 253.959 143.023C253.959 159.836 247.28 175.959 235.392 187.848C223.503 199.736 207.379 206.415 190.567 206.415H174.719" stroke="black" stroke-width="31.6959" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-xl">
                    Kembali
                </p>
            </a>
        </div>

        <div class="flex w-full gap-3">
            <div class="w-2/3">
                <div style="width:100%" class="mb-3 h-16 bg-white rounded-t-xl pt-3 px-10 flex justify-between" style="width:64%;">
                    <p class="text-xl font-bold">
                        {{$total_item_keranjang}} Item
                    </p>
                    <p class="text-xl font-bold text-red-600 hover:text-red-800">
                        Hapus
                    </p>
                </div>
                @foreach($menus_with_jumlah_keranjang as $item)
                <div style="width:100%" class="mb-3 h-44 bg-white pt-3 px-10 flex justify-between" style="width:64%;">
                    @if($item['menu']->jenis == "Makanan")
                    <img style="object-fit: cover; width: 12rem; height:85%;" src="{{ asset('storage/images/makanan/' . $item['menu']->foto) }}" alt="{{ $item['menu']->nama }}">
                    @else
                    <img style="object-fit: cover; width: 12rem; height:85%;" src="{{ asset('storage/images/minuman/' . $item['menu']->foto) }}" alt="{{ $item['menu']->nama }}">

                    @endif

                    <p class="text-lg font-bold">Nama Menu: {{ $item['menu']->nama }}</p>
                    <div class="text-xl text-right">
                        <p>Rp. {{ number_format($item['menu']->harga, 0, ',', '.') }}</p>
                        <div class="border-1 border-gray-400 w-20 h-8 bg-white mt-20 rounded flex justify-between px-2 font-bold">
                            <form action="{{ route('hapus-keranjang') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_menu" value="{{ $item['menu']->id }}">
                                <button type="submit" class="text-red-600">-</button>
                            </form>
                            <p>{{ $item['jumlah_keranjang'] }}</p>
                            <form action="{{ route('tambah-keranjang') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_menu" value="{{ $item['menu']->id }}">
                                <button type="submit" class="text-hijau">+</button>
                            </form>
                        </div>
                    </div>

                </div>
                @endforeach

            </div>
            <div class="w-3/9">
                <div class="bg-white rounded-xl p-8" style="width:23rem;height:30rem;">
                    <p class="text-xl font-bold mb-3">
                        Ringkasan Pesanan
                    </p>
                    <div class="w-full mt-2">
                        <form action="{{ route('meja_bayar', $id_transaksi) }}" onsubmit="submitForm(event)" method="POST">
                            @csrf

                            <div class="grid gap-6 mb-6 md:grid-cols-1">
                                <div>
                                    <label for="inputBayar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Bayar</label>
                                    <input name="total_bayar" oninput="tampilkanKembalian()" type="text" id="inputBayar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="5.000.000" required />
                                </div>
                                <div>
                                    <label for="meja" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No meja</label>
                                    <input value="{{$no_meja}}" name="no_meja" type="text" id="meja" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="10" required />
                                </div>
                                <input name="nama_kasir" type="text" hidden value="{{ Auth::user()->name }}">
                                <input name="total_harga" type="text" hidden value="{{ $total_harga }}">
                                <input name="no_meja" type="text" hidden value="{{ $transaction->no_meja }}">
                                <div class="w-full flex justify-between">
                                    <p class="text-xl ">
                                        Total
                                    </p>
                                    <p class="text-xl font-bold">
                                        Rp. {{ number_format($total_harga, 0, ',', '.') }},00
                                    </p>
                                </div>
                                <div class="w-full flex justify-between">
                                    <p class="text-xl ">
                                        Total Bayar
                                    </p>
                                    <p class="text-xl " id="outputBayar"></p>
                                </div>
                                <div class="w-full flex justify-between">
                                    <p class="text-xl ">
                                        Kembalian
                                    </p>
                                    <p class="text-xl " id="kembalian"></p>
                                </div>
                                <button type="submit" class="w-full mx-auto focus:outline-none text-white bg-hijau_muda hover:bg-lime-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Bayar</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #floating-btn {
        position: fixed;
        bottom: 50px;
        right: 50px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        font-size: 24px;
        text-align: center;
        line-height: 50px;
        text-decoration: none;
        z-index: 700;
    }

    #jumlah_keranjang {
        position: fixed;
        bottom: 120px;
        right: 50px;

        z-index: 1000;
    }

    #floating-btn:hover {
        background-color: #0056b3;
    }
</style>
<script>
    document.getElementById('minumanbtn').addEventListener('click', function() {
        document.getElementById('makanan').classList.add('hidden');
        document.getElementById('menu_makanan').classList.add('hidden');
        document.getElementById('minuman').classList.remove('hidden');
        document.getElementById('menu_minuman').classList.remove('hidden');
    });

    document.getElementById('btn').addEventListener('click', function() {
        document.getElementById('minuman').classList.add('hidden');
        document.getElementById('menu_minuman').classList.add('hidden');
        document.getElementById('makanan').classList.remove('hidden');
        document.getElementById('menu_makanan').classList.remove('hidden');
    });

    function formatNumber(input) {
        // Menghapus semua karakter selain angka dari input
        let value = input.value.replace(/\D/g, '');

        // Memformat angka dengan menambahkan titik sebagai pemisah ribuan
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Menetapkan nilai yang sudah diformat kembali ke input
        input.value = value;
    }

    function submitForm(event) {
        // Mengambil nilai input tanpa tanda titik
        let input = document.getElementById('bayar');
        let value = input.value.replace(/\D/g, '');

        // Mengubah nilai input menjadi angka
        input.value = value;
    }

    // Function untuk menambahkan koma sebagai pemisah ribuan
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function tampilkanKembalian() {
        var inputBayar = document.getElementById('inputBayar').value;
        document.getElementById('outputBayar').textContent = "Rp. " + numberWithCommas(inputBayar) + ",00";

        // Ambil nilai input dari inputBayar
        var inputBayar = document.getElementById('inputBayar').value;
        // Konversi nilai input menjadi angka
        var totalBayar = parseFloat(inputBayar.replace(/[^\d.-]/g, ''));
        // Variabel total_harga 
        var totalHarga = <?php echo str_replace('.', '', $total_harga); ?>; // Menghilangkan titik dari nilai total_harga

        // Hitung kembalian
        var kembalian = totalBayar - totalHarga;

        // Tampilkan kembalian di dalam elemen h1 dengan id 'kembalian'
        document.getElementById('kembalian').innerText = '' + formatRupiah(kembalian);
    }

    // Fungsi untuk mengubah format angka menjadi format mata uang Rupiah
    function formatRupiah(angka) {
        return 'Rp. ' + angka + ',00';
    }
</script>

@endsection