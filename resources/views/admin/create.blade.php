@extends('layouts.main')

@section('contents')

<div style="min-height: 100vh;" class="bg-bgutama">
    <nav class=" bg-coklat border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo/logo.png') }}" class="h-16" alt="Logo Cafe" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Cafe Bisa Ngopi</span>
            </a>
            <div class="flex h-14 gap-4">
                <p class="text-white align-middle mt-3 text-2xl">Buat Akun Baru</p>
            </div>
            <div class="flex h-14 gap-4">
                <p class="text-white align-middle mt-3 text-lg">{{auth()->user()->name}}</p>
            </div>
        </div>
    </nav>
    <div class="p-16 px-24">
        <div class="w-24 pt-3 ml-3">
            <a href="/admin" class="flex gap-2">
                <svg style="margin-top: 3px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 270 223" fill="none">
                    <path d="M79.6313 143.023L16.2396 79.6313M16.2396 79.6313L79.6313 16.2396M16.2396 79.6313H190.567C207.379 79.6313 223.503 86.3101 235.392 98.1983C247.28 110.087 253.959 126.211 253.959 143.023C253.959 159.836 247.28 175.959 235.392 187.848C223.503 199.736 207.379 206.415 190.567 206.415H174.719" stroke="black" stroke-width="31.6959" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="text-xl">
                    Kembali
                </p>
            </a>
        </div>
        <div class="w-full bg-white rounded-lg min-h-screen p-5">
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="mx-auto">
                @csrf

                <div class="grid gap-6 mb-6 md:grid-cols-1">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh: email@gmail.com" required name="email">
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input type="text" id="name" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Contoh: Budi Setiawan" required name="name">
                    </div>
                    <div>
                        <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis</label>
                        <select id="role_id" name="role_id" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="">--Pilih--</option>
                            <option value="1">Admin</option>
                            <option value="2">kasir</option>
                            <option value="3">Meja</option>
                            <option value="4">Manager</option>
                        </select>
                    </div>
                    <div>
                        <label for="Password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="py-2" x-data="{ show: true }">
                            <div class="relative">
                                <input placeholder="" :type="show ? 'password' : 'text'" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required name="password">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Simpan</button>
                <button type="reset" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Reset</button>
            </form>
        </div>
    </div>
</div>


@endsection