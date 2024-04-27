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
                <p class="text-white align-middle mt-3 text-2xl">Pesanan Baru</p>
            </div>
            <div class="flex h-14 gap-4">
                <p class="text-white align-middle mt-3 text-lg">{{auth()->user()->name}}</p>
                <div class="h-14 w-14 bg-white rounded-full">

                </div>
            </div>
        </div>
    </nav>
    <div class="p-16 px-24 pb-3">
        <div class="w-24 pt-3 ml-3">
            <a href="/kasir" class="flex gap-2">
                <svg style="margin-top: 3px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 270 223" fill="none">
                    <path d="M79.6313 143.023L16.2396 79.6313M16.2396 79.6313L79.6313 16.2396M16.2396 79.6313H190.567C207.379 79.6313 223.503 86.3101 235.392 98.1983C247.28 110.087 253.959 126.211 253.959 143.023C253.959 159.836 247.28 175.959 235.392 187.848C223.503 199.736 207.379 206.415 190.567 206.415H174.719" stroke="black" stroke-width="31.6959" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-xl">
                    Kembali
                </p>
            </a>
        </div>

        <div class="flex justify-between">
            <div class="flex ml-3 hidden mt-3" id="makanan">
                <div class="bg-white border-1 border-coklat w-32 h-10 rounded-tl-xl text-center" id="minumanbtn">
                    <p class="font-bold mt-2">
                        Minuman
                    </p>
                </div>
                <div class="bg-coklat border-1 border-black w-32 h-10 rounded-tl-xl text-center -ml-3">
                    <p class="text-white font-bold mt-2">
                        Makanan
                    </p>
                </div>
            </div>
            <div class="flex ml-3 mt-3" id="minuman">
                <div class="bg-coklat border-1 border-black w-32 h-10 rounded-tl-xl text-center -mr-3 z-10">
                    <p class="text-white font-bold mt-2">
                        Minuman
                    </p>
                </div>
                <div class="bg-white border-1 border-coklat w-32 h-10 rounded-tl-xl text-center" id="btn">
                    <p class="font-bold mt-2">
                        Makanan
                    </p>
                </div>
            </div>
            <div class="w-64">
                <form class="w-full ml-auto" action="/pesan" method="get">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Cari</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input style="padding-left:30px" type="search" name="search" id="default-search" class=" h-2 block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari" />
                        <button type="submit" class="text-white absolute end-2.5 bottom-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="menu_makanan" class="hidden w-full min-h-80 rounded mx-auto grid grid-cols-4 gap-1 pl-3 overflow-hidden">
            @foreach($menus_with_jumlah_keranjang_makanan as $item)
            <div class="bg-white h-80 rounded mb-3" style="width: 96%;">
                <div class="bg-black mx-auto mt-3 h-40 overflow-hidden" style="max-width: 80%;">
                    <img style="object-fit: cover; width: 100%; height:100%;" src="{{ asset('storage/images/makanan/' . $item['menu']->foto) }}" alt="{{ $item['menu']->nama }}">
                </div>
                <div class="ml-5 mt-3">
                    <p class="text-2xl">{{ $item['menu']->nama }}</p>
                </div>
                <div class="ml-5 mt-2">
                    <p class="text-2xl">Rp. {{ number_format($item['menu']->harga, 2, ',', '.') }}</p>
                </div>
                @if($item['jumlah_keranjang'] >= 1)
                <div class="mx-auto text-center flex gap-3 w-1/2">
                    <form action="{{ route('hapus-keranjang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_menu" value="{{ $item['menu']->id }}">
                        <button type="submit" class="focus:outline-none text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-full text-xl w-9 h-9 px-1 py-1 me-2 mb-2 ">-</button>
                    </form>
                    <p class="text-xl mt-1">
                        {{ $item['jumlah_keranjang'] }}
                    </p>
                    <form action="{{ route('tambah-keranjang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_menu" value="{{ $item['menu']->id }}">
                        <button type="submit" class="ml-2 focus:outline-none text-white bg-hijau_muda hover:bg-lime-600 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-xl w-9 h-9 px-1 py-1 me-2 mb-2 ">+</button>
                    </form>
                </div>
                @else
                <div class="mx-auto text-center">
                    <form action="{{ route('tambah-keranjang-kasir') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_menu" value="{{ $item['menu']->id }}">
                        <button type="submit" class="focus:outline-none text-white bg-hijau_muda hover:bg-lime-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</button>
                    </form>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <div id="menu_minuman" class="w-full min-h-80 rounded mx-auto grid grid-cols-4 gap-1 pl-3 overflow-hidden">
            @foreach($menus_with_jumlah_keranjang_minuman as $item)
            <div class="bg-white h-80 rounded mb-3" style="width: 96%;">
                <div class="bg-black mx-auto mt-3 h-40 overflow-hidden" style="max-width: 80%;">
                    <img style="object-fit: cover; width: 100%; height:100%;" src="{{ asset('storage/images/minuman/' . $item['menu']->foto) }}" alt="{{ $item['menu']->nama }}">
                </div>
                <div class="ml-5 mt-3">
                    <p class="text-2xl">{{ $item['menu']->nama }}</p>
                </div>
                <div class="ml-5 mt-2">
                    <p class="text-2xl">Rp. {{ number_format($item['menu']->harga, 2, ',', '.') }}</p>
                </div>
                @if($item['jumlah_keranjang'] >= 1)
                <div class="mx-auto text-center flex gap-3 w-1/2">
                    <form action="{{ route('hapus-keranjang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_menu" value="{{ $item['menu']->id }}">
                        <button type="submit" class="focus:outline-none text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-full text-xl w-9 h-9 px-1 py-1 me-2 mb-2 ">-</button>
                    </form>
                    <p class="text-xl mt-1">
                        {{ $item['jumlah_keranjang'] }}
                    </p>
                    <form action="{{ route('tambah-keranjang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_menu" value="{{ $item['menu']->id }}">
                        <button type="submit" class="ml-2 focus:outline-none text-white bg-hijau_muda hover:bg-lime-600 focus:ring-4 focus:ring-green-300 font-medium rounded-full text-xl w-9 h-9 px-1 py-1 me-2 mb-2 ">+</button>
                    </form>
                </div>
                @else
                <div class="mx-auto text-center">
                    <form action="{{ route('tambah-keranjang') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_menu" value="{{ $item['menu']->id }}">
                        <button type="submit" class="focus:outline-none text-white bg-hijau_muda hover:bg-lime-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah</button>
                    </form>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<a href="/keranjang" id="floating-btn" class="flex justify-center items-center bg-coklat">
    <svg class="h-16 w-16 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path fill="currentColor" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
    </svg>
</a>

<a href="/keranjang">
    <div id="jumlah_keranjang" class="w-7 h-7 bg-hijau_muda text-center rounded-full">
        <p class="text-lg font-extrabold text-white">
            {{$total_item_keranjang}}
        </p>
    </div>
</a>


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
</script>

@endsection