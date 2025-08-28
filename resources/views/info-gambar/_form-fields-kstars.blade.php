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
    <label>Urutan Tampil</label>
    <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $item['sortOrder'] ?? '0') }}">
    <small class="form-text text-muted">Angka lebih kecil akan tampil lebih dulu.</small>
</div>

<div class="form-group">
    <label for="image">File Gambar K-Stars</label>
    <input type="file" class="form-control" name="image" accept="image/*" {{ isset($item) ? '' : 'required' }}>
    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar saat mengedit.</small>
    
    @if(isset($item) && $item['imageUrl'])
        <div class="mt-3">
            <label>Gambar Saat Ini:</label><br>
            <img src="{{ config('services.adonis.public_url') }}/{{ $item['imageUrl'] }}" alt="{{ $item['title'] ?? 'K-Star Image' }}" height="100" class="mt-2 img-thumbnail">
        </div>
    @endif
</div>

<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="hidden" name="is_active" value="0">
        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ old('is_active', $item['isActive'] ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="isActive">
            Tampilkan di Website (Aktif)
        </label>
    </div>
</div>