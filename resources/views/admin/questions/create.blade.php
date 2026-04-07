<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Soal</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('questions.store') }}">
            @csrf

            @include('admin.questions._form')

            <button type="submit">Simpan</button>
        </form>
    </div>
</x-app-layout>