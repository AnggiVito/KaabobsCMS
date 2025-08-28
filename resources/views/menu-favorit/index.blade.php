@extends('componens.mainLogin')
@section('content')
<div class="page-inner">

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <form action="{{ route('menu-favorit.settings.update') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Pengaturan Judul</h4>
                    <button type="submit" class="btn btn-primary btn-round btn-sm ms-auto"><i class="fa fa-save"></i> Simpan Pengaturan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="menuFavoritTitle">Judul Menu Favorit</label>
                    <input type="text" class="form-control" name="menuFavoritTitle" 
                        value="{{ old('menuFavoritTitle', $settings->get('menuFavoritTitle')) }}" required>
                </div>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Daftar Item Menu Favorit</h4>
                <a href="{{ route('menu-favorit.create') }}" class="btn btn-primary btn-round btn-sm ms-auto"><i class="fa fa-plus"></i> Tambah Item</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-striped table-hover">
                    <thead><tr><th>Gambar</th><th>Judul</th><th>Urutan</th><th>Status</th><th style="width: 10%">Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td><img src="{{ config('services.adonis.public_url') }}/{{ $item['imageUrl'] }}" height="50"></td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['sortOrder'] }}</td>
                            <td><span class="badge {{ $item['isActive'] ? 'badge-success' : 'badge-danger' }}">{{ $item['isActive'] ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                            <td class="text-center"><div class="form-button-action justify-content-center">
                                <a href="{{ route('menu-favorit.edit', $item['id']) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('menu-favorit.destroy', $item['id']) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Hapus item ini?')"><i class="fa fa-times"></i></button>
                                </form>
                            </div></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection