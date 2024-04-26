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
                <p class="text-white align-middle mt-3 text-2xl">Riwayat Pesanan</p>
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
            <div class="flex justify-between">
                <form class="w-56 ml-auto" action="/riwayat" method="get">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        </div>
                        <input type="search" name="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari" />
                        <button type="submit" class="text-white absolute mb-2 end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
            </div>


            <div class="relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700  uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID Akun
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama kasir
                            </th>
                            <th scope="col" class="px-6 py-3">
                                No Meja
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Harga
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Biaya
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                        <tr class=" odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$transaction->id}}</td>
                            <td class="px-6 py-4">
                                {{$transaction->nama_kasir}}
                            </td>
                            <td class="px-6 py-4">{{$transaction->no_meja}}</td>
                            <td class="px-6 py-4">{{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ number_format($transaction->total_bayar, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('keranjang_meja', $transaction->no_meja) }}">
                                    <button type="button" class="text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-green-800 w-44">Bayar</button>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <div class="alert alert-danger">
                            Data Riwayat belum Tersedia.
                        </div>
                        @endforelse
                    </tbody>
                </table>
                {{$transactions->links()}}
            </div>
        </div>
    </div>
</div>


@endsection