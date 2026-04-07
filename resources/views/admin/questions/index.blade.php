<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Manage Questions</h2>
    </x-slot>

    <div class="p-6">

        <form method="GET" class="mb-4">
            <select name="category" onchange="this.form.submit()">
                <option value="">-- Filter Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>

        @foreach($questions as $question)
    <div class="border p-3 mb-2 flex justify-between items-center">
        <div>
            <strong>{{ $question->question_text }}</strong>
            <div class="text-sm text-gray-500">
                Category: {{ $question->category->name ?? '-' }}
            </div>
        </div>

        <div>
            <a href="{{ route('questions.edit', $question->id) }}" 
               class="text-blue-600 hover:underline">
               Edit
            </a>
            <form action="{{ route('questions.destroy', $question->id) }}" 
      method="POST" 
      style="display:inline;">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Yakin hapus soal ini?')">
        Delete
    </button>
</form>
        </div>
    </div>
@endforeach

        <div class="mt-4">
            {{ $questions->links() }}
            
        </div>
        
    </div>
</x-app-layout>