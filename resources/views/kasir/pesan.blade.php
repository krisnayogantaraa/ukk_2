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
                <p class="text-white align-middle mt-3 text-lg">Diana Hayandadi</p>
                <div class="h-14 w-14 bg-white rounded-full">

                </div>
            </div>
        </div>
    </nav>
    <div class="p-16 px-24">
        <p class="text-xl mb-4"><a href="/kasir">Dashboard/</a> Tambah Pesanan</p>
        <div class="flex justify-between">

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