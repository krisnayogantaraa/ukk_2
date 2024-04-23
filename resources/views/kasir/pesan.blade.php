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
                <p class="text-white align-middle mt-3 text-lg">Diana Hayandadi</p>
                <div class="h-14 w-14 bg-white rounded-full">

                </div>
            </div>
        </div>
    </nav>
    <div class="p-16 px-24">
        <div class="w-24">
            <a href="/kasir" class="flex gap-2">
                <svg style="margin-top: 3px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 270 223" fill="none">
                    <path d="M79.6313 143.023L16.2396 79.6313M16.2396 79.6313L79.6313 16.2396M16.2396 79.6313H190.567C207.379 79.6313 223.503 86.3101 235.392 98.1983C247.28 110.087 253.959 126.211 253.959 143.023C253.959 159.836 247.28 175.959 235.392 187.848C223.503 199.736 207.379 206.415 190.567 206.415H174.719" stroke="black" stroke-width="31.6959" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-xl mb-2">
                    Kembali
                </p>
            </a>
        </div>

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

<a href="/kasir" id="floating-btn" class="flex justify-center items-center bg-coklat">
    <svg class="h-16 w-16 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path fill="currentColor" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
    </svg>
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
        z-index: 1000;
    }

    #floating-btn:hover {
        background-color: #0056b3;
    }
</style>
<script>
</script>

@endsection