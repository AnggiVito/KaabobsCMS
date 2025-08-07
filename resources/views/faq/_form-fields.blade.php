@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="question">Pertanyaan (Question)</label>
    <textarea class="form-control" name="question" rows="3" required>{{ old('question', $faq['question'] ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="answer">Jawaban (Answer)</label>
    <textarea class="form-control" name="answer" rows="5" required>{{ old('answer', $faq['answer'] ?? '') }}</textarea>
</div>