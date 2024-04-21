@extends('layouts.main')

@section('contents')
<div class="d-flex justify-content-center align-items-center vh-100"
  style="background-image: url('{{ asset('images/bg/background_login.png') }}'); background-size: cover;background-position: center;background-repeat: no-repeat;">
  <div class="bg-coklat rounded-3xl p-6" style="width: 21rem; height: 28rem;">
    <div class="w-full flex justify-center">
      <div class="w-36 h-36">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo Cafe">
      </div>
    </div>
    <form action="/" method="post">
      @csrf
      <div class="w-full mt-4">
        <label for="email" class="block mb-2 text-base font-bold text-white">Email</label>
        <input type="text" id="email" name="email"
          class="bg-abu border-2 border-gray-300  text-white text-sm rounded-lg block w-full p-2.5 " required />
      </div>
      <div class="w-full mt-1.5">
        <label for="password" class="block mb-2 text-base font-bold text-white">Password</label>
        <input type="password" id="password" name="password"
          class="bg-abu border-2 border-gray-300  text-white text-sm rounded-lg block w-full p-2.5 " required />
      </div>
      <div class="h-2">
        @error('email')
        <strong class="font-bold text-sm text-red-600">Email Salah!</strong>
        @enderror
        @error('password')
        <strong class="font-bold text-sm text-red-600">Password Salah!</strong>
        @enderror
      </div>

      <div class="w-full flex justify-center mt-4">
        <button type="submit"
          class="text-white text-md font-bold bg-hijau focus:ring-4 focus:outline-none rounded-lg  w-full sm:w-auto px-5 py-2.5 text-center">Log
          In</button>
      </div>
    </form>
  </div>
</div>
@endsection