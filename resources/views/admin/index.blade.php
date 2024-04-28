@extends('layouts.main')

@section('contents')

<div style="height: 100vh;" class="bg-bgutama">
    <nav class=" bg-coklat border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo/logo.png') }}" class="h-16" alt="Logo Cafe" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Cafe Bisa Ngopi</span>
            </a>
            <div class="flex h-14 gap-4">
                <p class="text-white align-middle mt-3 text-2xl">Dashboard Admin</p>
            </div>
            <div class="flex h-14 gap-4">
                <p class="text-white align-middle mt-3 text-lg">{{auth()->user()->name}}</p>
            </div>
        </div>
    </nav>
    <div class="p-16 px-24">
        <div class="flex justify-between">
            <a href="/akun">
                <div class="bg-white rounded p-10 " style="height: 26rem; width:21rem;">
                    <div class="h-32 mx-auto">
                        <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="80" height="99" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                        </svg>
                    </div>
                    <p class=" font-normal text-4xl text-black text-center">Akun</p>
                    <p class="mt-3 font-normal text-xl text-black text-center">Berisi menu untuk modifikasi data akun</p>
                </div>
            </a>

            <a href="/logs-admin">
                <div class="bg-white rounded p-10" style="height: 26rem; width:21rem;">
                    <div class="h-32 mx-auto">
                        <svg class="mx-auto" width="80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                        </svg>
                    </div>
                    <p class=" font-normal text-4xl text-black text-center">Logs</p>
                    <p class="mt-3 font-normal text-xl text-black text-center">Berisi riwayat aktivitas</p>
                </div>
            </a>

            <div class="bg-white rounded p-10" style="height: 26rem; width:21rem;" id="logout">
                <div class="h-32 mx-auto">
                    <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="110" height="110" viewBox="0 0 110 110" fill="none">
                        <path d="M59.5834 55V55.0458" stroke="black" stroke-width="7.75683" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.75 96.25H96.25" stroke="black" stroke-width="7.75683" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22.9166 96.25V22.9167C22.9166 20.4855 23.8824 18.1539 25.6015 16.4349C27.3206 14.7158 29.6521 13.75 32.0833 13.75H66.4583M77.9166 61.875V96.25" stroke="black" stroke-width="7.75683" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M64.1666 32.0834H96.25M96.25 32.0834L82.5 18.3334M96.25 32.0834L82.5 45.8334" stroke="black" stroke-width="7.75683" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <p class=" font-normal text-4xl text-black text-center">Keluar <br> Akun</p>
                <p class="mt-3 font-normal text-xl text-black text-center">Tombol untuk keluar dari akun</p>
            </div>
        </div>
        <form id="logoutForm" action="/logout" method="post" style="display: none;">
            @csrf
            <button type="submit" id="logoutButton" style="display: none;"></button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var logout = document.getElementById('logout');
        var logoutForm = document.getElementById('logoutForm');

        logout.addEventListener('click', function() {
            logoutForm.submit();
        });
    });
</script>

@endsection