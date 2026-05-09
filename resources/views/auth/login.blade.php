<x-guest-layout>


    <style>
        body {
            overflow: hidden;
        }
    </style>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="min-h-screen px-6 py-10 md:justify-center md:items-center md:flex">
        <div class="max-w-md w-full">
            <h1 class="text-3xl font-semibold text-[#1A2B3E]">
            Silahkan Login
        </h1>

        <p class="text-gray-500 mt-2">
            Masukkan Data Anda
        </p>
        <form method="POST" action="{{ route('login') }} " class="mt-8">

            @csrf

            <div class="space-y-2">
                <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}"
                    class="w-full bg-white rounded-[15px] p-4 border border-[#E1E8F0] focus:outline-none focus:ring-2 focus:ring-[#1A2B3E]/10 placeholder:text-gray-400 transition"
                    required>

                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror


                
                <input type="password" name="password" autocomplete="current-password" placeholder="Masukkan Password"
                    class="w-full bg-white rounded-[15px] p-4 border border-[#E1E8F0] focus:outline-none focus:ring-2 focus:ring-[#1A2B3E]/10 placeholder:text-gray-400 transition"
                    required>

                @error('password')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

            </div>

            {{--  --}}
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            
           
<div class="flex items-center justify-between mt-4">

   
    <a href="{{ route('register') }}" class="text-md font-bold text-gray-600 hover:text-gray-900">
        Kembali ke sign up
    </a>

   
    <x-primary-button>
        Log in
    </x-primary-button>

</div>


            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif

               
            </div>
        </form>
        </div>
    </div>

</x-guest-layout>
