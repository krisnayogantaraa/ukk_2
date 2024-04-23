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
                <p class="text-white align-middle mt-3 text-lg">Diana Hayandadi</p>
                <div class="h-14 w-14 bg-white rounded-full">

                </div>
            </div>
        </div>
    </nav>
    <div class="p-16 px-24 pb-3">
        <div class="w-24 pt-3 ml-3 mb-2">
            <a href="/pesan" class="flex gap-2">
                <svg style="margin-top: 3px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 270 223" fill="none">
                    <path d="M79.6313 143.023L16.2396 79.6313M16.2396 79.6313L79.6313 16.2396M16.2396 79.6313H190.567C207.379 79.6313 223.503 86.3101 235.392 98.1983C247.28 110.087 253.959 126.211 253.959 143.023C253.959 159.836 247.28 175.959 235.392 187.848C223.503 199.736 207.379 206.415 190.567 206.415H174.719" stroke="black" stroke-width="31.6959" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-xl">
                    Kembali
                </p>
            </a>
        </div>

        <div class="flex w-full justify-between">
            <div class="h-16 bg-white rounded-t-xl" style="width:64%;">

            </div>
            <div class="h-80 bg-white rounded-xl" style="width:33%">

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
</script>

@endsection