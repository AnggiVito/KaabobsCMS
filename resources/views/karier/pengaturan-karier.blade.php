@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('karier-page.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">{{ $subTitle }}</h4>
                    <button type="submit" class="btn btn-success btn-round ms-auto"><i class="fa fa-check"></i> Simpan Perubahan</button>
                </div>
            </div>
            <div class="card-body">
                <p>Form ini digunakan untuk mengubah konten statis (judul, deskripsi, dan gambar) yang tampil di bagian atas halaman Karier di website utama Anda.</p>
                <hr>
                <div class="form-group">
                    <label>Judul Utama Halaman</label>
                    <input type="text" class="form-control" name="header_title" value="{{ old('header_title', $settings['headerTitle'] ?? '') }}" placeholder="Contoh: Bergabunglah Bersama Keluarga Besar Kabobs">
                </div>
                <div class="form-group">
                    <label>Deskripsi Paragraf 1</label>
                    <textarea class="form-control" name="header_desc1" rows="3">{{ old('header_desc1', $settings['headerDesc1'] ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Deskripsi Paragraf 2</label>
                    <textarea class="form-control" name="header_desc2" rows="3">{{ old('header_desc2', $settings['headerDesc2'] ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Gambar Header</label>
                    <input type="file" class="form-control" name="header_image" accept="image/*">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    @if(isset($settings['headerImage']) && $settings['headerImage'])
                        <div class="mt-2">
                            <label>Gambar Saat Ini:</label><br>
                            <img src="{{ config('services.adonis.public_url') }}/{{ $settings['headerImage'] }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                        </div>
                    @endif
                </div>
                <hr>
                <div class="form-group">
                    <label>Judul Seksi Lowongan</label>
                    <input type="text" class="form-control" name="section_title" value="{{ old('section_title', $settings['sectionTitle'] ?? '') }}" placeholder="Contoh: Posisi yang Terbuka">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection