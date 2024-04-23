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
                <p class="text-white align-middle mt-3 text-lg">Diana Hayandadi</p>
                <div class="h-14 w-14 bg-white rounded-full">

                </div>
            </div>
        </div>
    </nav>
    <div class="p-16 px-24">
        <p class="text-xl mb-2"><a href="/kasir">Dashboard/</a> Tambah Pesanan</p>
        <div class="w-full min-h-80 rounded mx-auto grid grid-cols-4 gap-1 pl-3 overflow-hidden">
            <div class=" bg-white h-80 rounded mb-3" style="width: 96%;">
                <div class="bg-black mx-auto mt-3 w-56 h-40">
                    <img style="object-fit: cover; height:100%;" src="{{ asset('images/makanan/donut.jpeg') }}" alt="">
                </div>
                <div class="ml-5 mt-3">
                    <p class="text-2xl">Donut</p>
                </div>
                <div class="ml-5 mt-2">
                    <p class="text-2xl">Rp. 5.000,00</p>
                </div>
                <div class="flex justify-center items-center mt-2">
                    <button type="button" class="focus:outline-none text-white bg-hijau_muda hover:bg-lime-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">+ Tambah</button>
                </div>
            </div>
            <div class=" bg-white h-80 rounded mb-3" style="width: 96%;">
                <div class="bg-blue-800 mx-auto mt-3 w-56 h-40 ">
                    <img style="background-size: cover; background-position: center; background-repeat: no-repeat; height:100%; width:100%;" src="{{ asset('images/makanan/bala_bala.jpg') }}" alt="">
                </div>
                <div class="ml-5 mt-3">
                    <p class="text-2xl">Bala-bala</p>
                </div>
                <div class="ml-5 mt-2">
                    <p class="text-2xl">Rp. 5.000,00</p>
                </div>
                <div class="flex justify-center items-center mt-2">
                    <button type="button" class="focus:outline-none text-white bg-hijau_muda hover:bg-lime-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">+ Tambah</button>
                </div>
            </div>
            <div class=" bg-white h-80 rounded mb-3" style="width: 96%;">
                <div class="bg-red-800 mx-auto mt-3 w-56 h-40">
                    <img style="background-size: cover; background-position: center; background-repeat: no-repeat; height:100%; width:100%;" src="{{ asset('images/makanan/mendoan.jpg') }}" alt="">
                </div>
                <div class="ml-5 mt-3">
                    <p class="text-2xl">Tempe Mendoan</p>
                </div>
                <div class="ml-5 mt-2">
                    <p class="text-2xl">Rp. 5.000,00</p>
                </div>
                <div class="flex justify-center items-center mt-2">
                    <button type="button" class="focus:outline-none text-white bg-hijau_muda hover:bg-lime-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">+ Tambah</button>
                </div>
            </div>
            <div class=" bg-white h-80 rounded mb-3" style="width: 96%;">
                <div class="bg-red-800 mx-auto mt-3 w-56 h-40">
                    <img style="background-size: cover; background-position: center; background-repeat: no-repeat; height:100%; width:100%;" src="{{ asset('images/makanan/churros.jpg') }}" alt="">
                </div>
                <div class="ml-5 mt-3">
                    <p class="text-2xl">Churros</p>
                </div>
                <div class="ml-5 mt-2">
                    <p class="text-2xl">Rp. 5.000,00</p>
                </div>
                <div class="flex justify-center items-center mt-2">
                    <button type="button" class="focus:outline-none text-white bg-hijau_muda hover:bg-lime-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">+ Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
</script>

@endsection