@if ($errors->any())
    <div class="alert alert-danger">
        <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
    </div>
@endif

<div class="col-md-6 form-group">
    <label for="name">Nama Menu</label>
    <input type="text" class="form-control" name="name" value="{{ old('name', $menu['name'] ?? '') }}" required>
</div>

<div class="col-md-6 form-group">
    <label for="category">Kategori</label>
    <select name="category" class="form-control" required>
        @php
            $categories = ['Kebab', 'Drinks', 'Snacks', 'Fun Box', 'Fun Set', 'Combobs', 'Combo Seru', 'Seasonal Menu'];
            $selectedCategory = old('category', $menu['category'] ?? '');
        @endphp
        @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ $selectedCategory == $cat ? 'selected' : '' }}>{{ $cat }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-6 form-group">
    <label for="image">Gambar Produk</label>
    <input type="file" class="form-control" name="image" accept="image/*">
    @if(isset($menu) && $menu['image'])
        <div class="mt-2">
            <small>Gambar saat ini:</small><br>
            <img src="{{ config('services.adonis.public_url') }}/{{ $menu['image'] }}" alt="{{ $menu['name'] }}" height="100">
        </div>
    @endif
</div>