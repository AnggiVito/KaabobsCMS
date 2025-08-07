@if ($errors->any())
    <div class="alert alert-danger">
        <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
    </div>
@endif

<div class="form-group">
    <label for="title">Judul Promo</label>
    <input type="text" class="form-control" name="title" value="{{ old('title', $promo['title'] ?? '') }}" required>
</div>
<div class="form-group">
    <label for="description">Deskripsi</label>
    <textarea class="form-control" name="description" rows="5" required>{{ old('description', $promo['description'] ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="expired">Tanggal Berakhir</label>
    <input type="date" class="form-control" name="expired" value="{{ old('expired', isset($promo) ? \Carbon\Carbon::parse($promo['expired'])->format('Y-m-d') : '') }}" required>
</div>
<div class="form-group">
    <label for="image">Gambar Promo</label>
    <input type="file" class="form-control" name="image" accept="image/*">
    @if(isset($promo) && $promo['image'])
        <div class="mt-2">
            <small>Gambar saat ini:</small><br>
            <img src="{{ config('services.adonis.public_url') }}/{{ $promo['image'] }}" alt="{{ $promo['title'] }}" height="100">
        </div>
    @endif
</div>