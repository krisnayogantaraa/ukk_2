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
                <p class="text-white align-middle mt-3 text-2xl">Dashboard Manajer</p>
            </div>
            <div class="flex h-14 gap-4">
                <p class="text-white align-middle mt-3 text-lg">{{auth()->user()->name}}</p>
            </div>
        </div>
    </nav>
    <div class="p-16 px-24">
        <div class="flex justify-between">
            <a href="/menu">
                <div class="bg-white rounded p-10 " style="height: 26rem; width:21rem;">
                    <div class="h-32 mx-auto">
                        <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="80" height="99" viewBox="0 0 80 99" fill="none">
                            <path d="M39.9808 2.93933C40.1346 3.84812 43.0769 21.2117 43.0769 27.844C43.0769 37.9566 37.7308 45.1689 29.8269 48.0693L32.3077 94.108C32.4423 96.757 30.3462 99 27.6923 99H15.3846C12.75 99 10.6346 96.7764 10.7692 94.108L13.25 48.0693C5.32692 45.1689 0 37.9373 0 27.844C0 21.1924 2.94231 3.84812 3.09615 2.93933C3.71154 -0.985854 11.8077 -1.04386 12.3077 3.15203V30.4543C12.5577 31.1117 15.2115 31.073 15.3846 30.4543C15.6538 25.5623 16.9038 3.53874 16.9231 3.03601C17.5577 -0.985854 25.5192 -0.985854 26.1346 3.03601C26.1731 3.55808 27.4038 25.5623 27.6731 30.4543C27.8462 31.073 30.5192 31.1117 30.75 30.4543V3.15203C31.25 -1.02453 39.3654 -0.985854 39.9808 2.93933ZM62.9038 58.182L60.0192 93.9727C59.7885 96.6797 61.9231 99 64.6154 99H75.3846C77.9423 99 80 96.9311 80 94.3594V4.64089C80 2.08855 77.9423 0.000276359 75.3846 0.000276359C59.5192 0.000276359 32.8077 34.5148 62.9038 58.182Z" fill="black" />
                        </svg>
                    </div>
                    <p class=" font-normal text-4xl text-black text-center">Menu</p>
                    <p class="mt-3 font-normal text-xl text-black text-center">Berisi Data Menu</p>
                </div>
            </a>
            <a href="/logs">
                <div class="bg-white rounded p-10" style="height: 26rem; width:21rem;">
                    <div class="h-32 mx-auto">
                        <svg class="mx-auto" width="80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
                        </svg>
                    </div>
                    <p class=" font-normal text-4xl text-black text-center">Logs</p>
                    <p class="mt-3 font-normal text-xl text-black text-center">Berisi riwayat aktivitas akun</p>
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