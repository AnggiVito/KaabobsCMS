@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Manajemen Gambar Galeri</h4>
                <a href="{{ route('gallery.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah Gambar</a>
            </div>
        </div>
        <div class="card-body">
            <table class="display table table-striped table-hover">
                <thead><tr><th>Gambar</th><th>Urutan</th><th>Status</th><th style="width: 10%">Aksi</th></tr></thead>
                <tbody>
                    @forelse ($galleryItems as $item)
                    <tr>
                        <td><img src="{{ config('services.adonis.public_url') }}/{{ $item['imageUrl'] }}" height="50"></td>
                        <td>{{ $item['sortOrder'] }}</td>
                        <td><span class="badge {{ $item['isActive'] ? 'badge-success' : 'badge-danger' }}">{{ $item['isActive'] ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                        <td class="text-center"><div class="form-button-action justify-content-center">
                            <a href="{{ route('gallery.edit', $item['id']) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('gallery.destroy', $item['id']) }}" method="POST" class="d-inline"> @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Hapus gambar ini?')"><i class="fa fa-times"></i></button>
                            </form>
                        </div></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center">Belum ada gambar galeri.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Manajemen Ikon Media Sosial</h4>
                <a href="{{ route('gallery.icon.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah Ikon</a>
            </div>
        </div>
        <div class="card-body">
            <table class="display table table-striped table-hover">
                <thead><tr><th>Ikon</th><th>Nama Media Sosial</th><th>URL</th><th>Status</th><th style="width: 10%">Aksi</th></tr></thead>
                <tbody>
                    @forelse ($sosmedIconItems as $item)
                    <tr>
                        <td><img src="{{ config('services.adonis.public_url') }}/{{ $item['imageUrl'] }}" height="30" style="background-color: #333; padding: 5px; border-radius: 5px;"></td>
                        <td>{{ $item['title'] }}</td>
                        <td><a href="{{ $item['linkUrl'] }}" target="_blank">Link</a></td>
                        <td><span class="badge {{ $item['isActive'] ? 'badge-success' : 'badge-danger' }}">{{ $item['isActive'] ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                        <td class="text-center"><div class="form-button-action justify-content-center">
                            <a href="{{ route('gallery.icon.edit', $item['id']) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                            <form action="{{ route('gallery.icon.destroy', $item['id']) }}" method="POST" class="d-inline"> @csrf @method('DELETE')
                                <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Hapus ikon ini?')"><i class="fa fa-times"></i></button>
                            </form>
                        </div></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center">Belum ada ikon media sosial.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection