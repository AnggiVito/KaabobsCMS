@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6 form-group">
        <label for="name">Nama Lokasi</label>
        <input type="text" class="form-control" name="name" placeholder="Contoh: Cabang Dago" value="{{ old('name', $location['name'] ?? '') }}" required>
    </div>
    <div class="col-md-6 form-group">
        <label for="region_name">Nama Wilayah</label>
        <input type="text" class="form-control" name="region_name" placeholder="Contoh: Bandung Kota" value="{{ old('region_name', $location['regionName'] ?? '') }}" required>
    </div>
</div>
<div class="form-group">
    <label for="address">Alamat Lengkap</label>
    <textarea class="form-control" name="address" rows="3" required>{{ old('address', $location['address'] ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="map_url">URL Google Maps</label>
    <input type="url" class="form-control" name="map_url" placeholder="https://maps.app.goo.gl/..." value="{{ old('map_url', $location['mapUrl'] ?? '') }}" required>
</div>
<div class="row">
    <div class="col-md-6 form-group">
        <label for="lat">Latitude</label>
        <input type="text" class="form-control" name="lat" placeholder="-6.89..." value="{{ old('lat', $location['lat'] ?? '') }}">
    </div>
    <div class="col-md-6 form-group">
        <label for="lng">Longitude</label>
        <input type="text" class="form-control" name="lng" placeholder="107.61..." value="{{ old('lng', $location['lng'] ?? '') }}">
    </div>
</div>