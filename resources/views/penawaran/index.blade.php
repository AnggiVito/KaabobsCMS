@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    @if(session('success')) 
        <div class="alert alert-success">{{ session('success') }}</div> 
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
        </div>
    @endif

    <form action="{{ route('penawaran.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Pengaturan Seksi</h4>
                    <button type="submit" class="btn btn-primary btn-round btn-sm ms-auto"><i class="fa fa-save"></i> Simpan Pengaturan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="penawaranSpesialTitle">Judul Seksi Penawaran</label>
                    <input type="text" class="form-control" name="penawaranSpesialTitle" 
                        value="{{ old('penawaranSpesialTitle', $settings->get('penawaranSpesialTitle')) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="penawaranFixedImage">Upload Gambar Fixed Baru</label>
                    <input type="file" class="form-control" name="penawaranFixedImage" accept="image/*">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    
                    @if($settings->has('penawaranFixedImage') && $settings->get('penawaranFixedImage') != '')
                    <div class="mt-3">
                        <label>Gambar Fixed Saat Ini:</label><br>
                        <img src="{{ config('services.adonis.public_url') }}/{{ $settings->get('penawaranFixedImage') }}" 
                            alt="Gambar Latar Penawaran" class="img-thumbnail" style="max-height: 150px;">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Daftar Item Penawaran</h4>
                <a href="{{ route('penawaran.create') }}" class="btn btn-primary btn-round btn-sm ms-auto"><i class="fa fa-plus"></i> Tambah Item</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td><img src="{{ config('services.adonis.public_url') }}/{{ $item['imageUrl'] }}" height="50"></td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['sortOrder'] }}</td>
                            <td><span class="badge {{ $item['isActive'] ? 'badge-success' : 'badge-danger' }}">{{ $item['isActive'] ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                            <td class="text-center">
                                <div class="form-button-action justify-content-center">
                                    <a href="{{ route('penawaran.edit', $item['id']) }}" class="btn btn-link btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('penawaran.destroy', $item['id']) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Hapus" onclick="return confirm('Hapus item ini?')"><i class="fa fa-times"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada item penawaran.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#add-row').DataTable({ "pageLength": 10 });
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>
@endpush