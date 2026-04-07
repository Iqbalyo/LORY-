<x-guest-layout>

<style>
body{
    font-family:'Montserrat',sans-serif;
    background:#F5F7FA;
    overflow: hidden;
}
</style>

<div class="min-h-screen px-6 pt-10">

    <!-- Title -->
    <h1 class="text-3xl font-semibold text-[#1A2B3E]">
        Register
    </h1>

    <!-- subtitle -->
    <p class="text-gray-500 mt-2">
        Masukkan Data Anda
    </p>

<form method="POST" action="{{ route('register') }}" class="mt-8">
@csrf

    <div class="space-y-4">

        <!-- Name -->
        <input
        type="text"
        name="name"
        placeholder="Nama"
        value="{{ old('name') }}"
        class="w-full rounded-[15px] bg-white p-4 border border-[#E1E8F0] focus:outline-none focus:ring-2 focus:ring-[#1A2B3E]/10 placeholder:text-gray-400 transition"
        required
        >

        @error('name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror


        <!-- Email -->
        <input
        type="email"
        name="email"
        placeholder="Masukkan Email"
        value="{{ old('email') }}"
        class="w-full bg-white rounded-[15px] p-4 border border-[#E1E8F0] focus:outline-none focus:ring-2 focus:ring-[#1A2B3E]/10 placeholder:text-gray-400 transition"
        required
        >

        @error('email')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror


        <!-- Password -->
        <input
        type="password"
        name="password"
        placeholder="Masukkan Password"
        class="w-full bg-white rounded-[15px] p-4 border border-[#E1E8F0] focus:outline-none focus:ring-2 focus:ring-[#1A2B3E]/10 placeholder:text-gray-400 transition"
        required
        >

        @error('password')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror


        <!-- Confirm Password -->
        <input
        type="password"
        name="password_confirmation"
        placeholder="Masukkan Kembali Password"
        class="w-full bg-white rounded-[15px] p-4 border border-[#E1E8F0] focus:outline-none focus:ring-2 focus:ring-[#1A2B3E]/10 placeholder:text-gray-400 transition"
        required
        >

    </div>

    <!-- Sign Up Button -->
    <button
    type="submit"
    class="w-full mt-8 bg-[#1A2B3E] text-white p-4 rounded-[15px] font-semibold"
    >
        Sign Up
    </button>

</form>

<!-- Divider -->
<p class="text-center text-gray-400 mt-6">
    atau
</p>

<!-- Login text -->
<p class="text-center mt-4 text-gray-500">
    Sudah punya akun?
    <a href="{{ route('login') }}" class="text-[#1A2B3E] font-semibold">
        Login
    </a>
</p>

</div>

</x-guest-layout>