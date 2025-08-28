@if ($errors->any())<div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

<div class="form-group">
    <label>Judul Gambar (Opsional)</label>
    <input type="text" class="form-control" name="title" value="{{ old('title', $item['title'] ?? '') }}">
</div>
<div class="form-group">
    <label>Urutan Tampil</label>
    <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $item['sortOrder'] ?? '') }}">
</div>
<div class="form-group">
    <label for="image">File Gambar</label>
    <input type="file" class="form-control" name="image" accept="image/*" {{ isset($item) ? '' : 'required' }}>
    @if(isset($item) && $item['imageUrl'])
        <img src="{{ config('services.adonis.public_url') }}/{{ $item['imageUrl'] }}" alt="{{ $item['title'] }}" height="100" class="mt-2 img-thumbnail">
    @endif
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ old('is_active', $item['isActive'] ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="isActive">Aktifkan</label>
</div>