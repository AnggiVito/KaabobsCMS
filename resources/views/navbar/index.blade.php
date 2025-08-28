@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <div class="card">
        <div class="card-header">
            <div class="card-title">Pengaturan Logo Navbar</div>
        </div>
        <form action="{{ route('navbar.logo.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="image">Upload Logo Baru (Tipe: Logo)</label>
                    <input type="file" class="form-control" name="image" accept="image/png, image/svg+xml" required>
                    <small class="form-text text-muted">File SVG atau PNG transparan direkomendasikan.</small>
                    @if($logoItem)
                        <div class="mt-2">
                            <label>Logo Saat Ini:</label><br>
                            <img src="{{ config('services.adonis.public_url') }}/{{ $logoItem['imageUrl'] }}" alt="Logo" height="40" style="background-color: #333; padding: 5px; border-radius: 5px;">
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-primary">Update Logo</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header"><div class="d-flex align-items-center"><h4 class="card-title">Link Navigasi Utama</h4><a href="{{ route('navbar.navlink.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah Link Utama</a></div></div>
        <div class="card-body">
            <table class="display table table-striped table-hover">
                <thead><tr><th>Label</th><th>URL</th><th>Urutan</th><th style="width: 10%">Aksi</th></tr></thead>
                <tbody>
                    @forelse ($navLinkItems as $item)
                    <tr>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['linkUrl'] }}</td>
                        <td>{{ $item['sortOrder'] }}</td>
                        <td class="text-center">
                        </td>
                    </tr>
                    @empty <tr><td colspan="4" class="text-center">Belum ada link utama.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><div class="d-flex align-items-center"><h4 class="card-title">Gambar Dropdown Menu</h4><a href="{{ route('navbar.thumb.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah Gambar</a></div></div>
        <div class="card-body">
            <table class="display table table-striped table-hover">
                <thead><tr><th>Gambar</th><th>Urutan</th><th style="width: 10%">Aksi</th></tr></thead>
                <tbody>
                    @forelse ($thumbItems as $item)
                    <tr>
                        <td><img src="{{ config('services.adonis.public_url') }}/{{ $item['imageUrl'] }}" height="50" style="background-color: #333; padding: 5px; border-radius: 5px;"></td>
                        <td>{{ $item['sortOrder'] }}</td>
                        <td class="text-center">
                            <form action="{{ route('navbar.thumb.destroy', $item['id']) }}" method="POST"> @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Hapus gambar ini?')"><i class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty <tr><td colspan="3" class="text-center">Belum ada gambar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><div class="d-flex align-items-center"><h4 class="card-title">Link Dropdown Menu</h4><a href="{{ route('navbar.link.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah Link</a></div></div>
        <div class="card-body">
            <table class="display table table-striped table-hover">
                <thead><tr><th>Label</th><th>URL</th><th>Urutan</th><th style="width: 10%">Aksi</th></tr></thead>
                <tbody>
                    @forelse ($linkItems as $item)
                    <tr>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['linkUrl'] }}</td>
                        <td>{{ $item['sortOrder'] }}</td>
                        <td class="text-center">
                            <div class="form-button-action justify-content-center">
                                <a href="{{ route('navbar.link.edit', $item['id']) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('navbar.link.destroy', $item['id']) }}" method="POST"> @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Hapus link ini?')"><i class="fa fa-times"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty <tr><td colspan="4" class="text-center">Belum ada link.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><div class="d-flex align-items-center"><h4 class="card-title">Link Dropdown Tentang Kabobs</h4><a href="{{ route('tentang-link.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah Link</a></div></div>
        <div class="card-body">
            <table class="display table table-striped table-hover">
                <thead><tr><th>Label</th><th>URL</th><th>Urutan</th><th style="width: 10%">Aksi</th></tr></thead>
                <tbody>
                    @forelse ($tentangLinkItems as $item)
                    <tr>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['linkUrl'] }}</td>
                        <td>{{ $item['sortOrder'] }}</td>
                        <td class="text-center">
                            <div class="form-button-action justify-content-center">
                                <a href="{{ route('tentang-link.edit', $item['id']) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('tentang-link.destroy', $item['id']) }}" method="POST"> @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Hapus link ini?')"><i class="fa fa-times"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty <tr><td colspan="4" class="text-center">Belum ada link.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection