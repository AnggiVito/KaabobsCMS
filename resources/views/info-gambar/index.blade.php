@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
        </div>
    @endif
    
    <form action="{{ route('info-gambar.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="page-header">
            <h4 class="page-title">{{ $subTitle }}</h4>
            <div class="ms-auto">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan Semua Perubahan</button>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><div class="card-title">Seksi "Mulai Pesan"</div></div>
            <div class="card-body">
                <div class="form-group">
                    <label>Teks Ajakan (startOrderText)</label>
                    <input type="text" class="form-control" name="startOrderText" value="{{ old('startOrderText', $settings->get('startOrderText')) }}">
                </div>
            </div>
        </div>

        <div class="row">
            {{-- KOLOM KIRI --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><div class="card-title">Seksi Menu Kiri</div></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Gambar Dasar (menuKiriImageBase)</label>
                            <input type="file" class="form-control" name="menuKiriImageBase">
                            @if($settings->has('menuKiriImageBase'))
                                <img src="{{ config('services.adonis.public_url') }}/{{ $settings->get('menuKiriImageBase') }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Gambar Hover (menuKiriImageHover)</label>
                            <input type="file" class="form-control" name="menuKiriImageHover">
                            @if($settings->has('menuKiriImageHover'))
                                <img src="{{ config('services.adonis.public_url') }}/{{ $settings->get('menuKiriImageHover') }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><div class="card-title">Seksi Cara Order</div></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Gambar Dasar (caraOrderImageBase)</label>
                            <input type="file" class="form-control" name="caraOrderImageBase">
                            @if($settings->has('caraOrderImageBase'))
                                <img src="{{ config('services.adonis.public_url') }}/{{ $settings->get('caraOrderImageBase') }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Gambar Hover (caraOrderImageHover)</label>
                            <input type="file" class="form-control" name="caraOrderImageHover">
                            @if($settings->has('caraOrderImageHover'))
                                <img src="{{ config('services.adonis.public_url') }}/{{ $settings->get('caraOrderImageHover') }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><div class="card-title">Seksi Outlet Kanan</div></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Gambar (outletKananImage)</label>
                            <input type="file" class="form-control" name="outletKananImage">
                            @if($settings->has('outletKananImage'))
                                <img src="{{ config('services.adonis.public_url') }}/{{ $settings->get('outletKananImage') }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"><div class="card-title">Seksi Kebab Maker</div></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Gambar Dasar (kebabMakerImageBase)</label>
                            <input type="file" class="form-control" name="kebabMakerImageBase">
                            @if($settings->has('kebabMakerImageBase'))
                                <img src="{{ config('services.adonis.public_url') }}/{{ $settings->get('kebabMakerImageBase') }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Gambar Overlay (kebabMakerImageOverlay)</label>
                            <input type="file" class="form-control" name="kebabMakerImageOverlay">
                            @if($settings->has('kebabMakerImageOverlay'))
                                <img src="{{ config('services.adonis.public_url') }}/{{ $settings->get('kebabMakerImageOverlay') }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Manajemen Gambar K-Stars</h4>
                    <a href="{{ route('k-stars.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah K-Stars</a>
                </div>
            </div>
            <div class="card-body">
                <table class="display table table-striped table-hover">
                    <thead><tr><th>Gambar</th><th>Urutan</th><th>Status</th><th style="width: 10%">Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($kStarItems as $item)
                        <tr>
                            <td><img src="{{ config('services.adonis.public_url') }}/{{ $item['imageUrl'] }}" height="50"></td>
                            <td>{{ $item['sortOrder'] }}</td>
                            <td><span class="badge {{ $item['isActive'] ? 'badge-success' : 'badge-danger' }}">{{ $item['isActive'] ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                            <td class="text-center"><div class="form-button-action justify-content-center">
                                <a href="{{ route('k-stars.edit', $item['id']) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('k-stars.destroy', $item['id']) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Hapus gambar ini?')"><i class="fa fa-times"></i></button>
                                </form>
                            </div></td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Belum ada data K-Stars.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection