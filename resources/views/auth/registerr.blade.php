<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Lory</title>

@vite('resources/css/app.css')

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

<style>
body{
    font-family:'Montserrat',sans-serif;
    background:#F5F7FA;
}
</style>

</head>

<body>

<div class="min-h-screen px-6 pt-10">

    <!-- Title -->
    <h1 class="text-3xl font-semibold text-[#1A2B3E]">
        Register
    </h1>

    <!-- subtitle -->
    <p class="text-gray-500 mt-2">
        Masukkan email and password
    </p>


    <!-- Form -->
    <div class="mt-8 space-y-4">

        <input
        type="email"
        placeholder="Masukkan Email"
        class="w-full bg-white p-4 rounded-[15px] shadow-sm outline-none"
        >

        <input
        type="password"
        placeholder="Masukkan Password"
        class="w-full bg-white p-4 rounded-[15px] shadow-sm outline-none"
        >

        <input
        type="password"
        placeholder="Masukkan Kembali Password"
        class="w-full bg-white p-4 rounded-[15px] shadow-sm outline-none"
        >

    </div>


    <!-- Sign Up Button -->
    <button class="w-full mt-8 bg-[#1A2B3E] text-white p-4 rounded-[15px] font-semibold">
        Sign Up
    </button>


    <!-- Divider -->
    <p class="text-center text-gray-400 mt-6">
        atau
    </p>


    <!-- Login text -->
    <p class="text-center mt-4 text-gray-500">
        Sudah punya akun?
        <a href="#" class="text-[#1A2B3E] font-semibold">
            Login
        </a>
    </p>

</div>

</body>
</html>