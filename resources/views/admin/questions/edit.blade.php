<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Soal</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('questions.update', $question->id) }}">
            @csrf
            @method('PUT')

            @include('admin.questions._form')

            <button type="submit">Update</button>
        </form>
    </div>
</x-app-layout>