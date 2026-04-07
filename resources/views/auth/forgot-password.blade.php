<x-guest-layout>

    <style>
        body {
            overflow: hidden;
        }
    </style>
    <div class="mb-4 text-sm text-gray-600 px-6 pt-10">
        {{ __('Lupa Password? aman masukkin aja email anda,nanti kami kirim ulang dan kamu bisa bebas ganti password :)') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="mt-8">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2 px-6">
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

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
        </div>
       

        
    </form>
</x-guest-layout>
