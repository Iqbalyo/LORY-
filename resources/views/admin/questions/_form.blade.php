<div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $question->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Pertanyaan</label>
    <textarea name="question_text" required>{{ old('question_text', $question->question_text ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Option A</label>
    <input type="text" name="option_a"
        value="{{ old('option_a', $question->option_a ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Option B</label>
    <input type="text" name="option_b"
        value="{{ old('option_b', $question->option_b ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Option C</label>
    <input type="text" name="option_c"
        value="{{ old('option_c', $question->option_c ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Option D</label>
    <input type="text" name="option_d"
        value="{{ old('option_d', $question->option_d ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Option E</label>
    <input type="text" name="option_e"
        value="{{ old('option_e', $question->option_e ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Jawaban Benar</label>
    <select name="correct_answer" required>
        @foreach(['A','B','C','D','E'] as $option)
            <option value="{{ $option }}"
                {{ old('correct_answer', $question->correct_answer ?? '') == $option ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Pembahasan</label>
    <textarea name="explanation">{{ old('explanation', $question->explanation ?? '') }}</textarea>
</div>