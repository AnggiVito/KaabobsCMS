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

    <form action="{{ route('contact-settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">{{ $subTitle }}</h4>
                    <button type="submit" class="btn btn-success btn-round ms-auto"><i class="fa fa-check"></i> Simpan Perubahan</button>
                </div>
            </div>
            <div class="card-body">
                {{-- Gunakan akses array dan camelCase sesuai response API AdonisJS --}}

                <div class="form-group">
                    <label>Judul Halaman</label>
                    <input type="text" class="form-control" name="page_title" value="{{ old('page_title', $settings['pageTitle'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Sub-Judul Halaman</label>
                    <textarea class="form-control" name="page_subtitle" rows="2">{{ old('page_subtitle', $settings['pageSubtitle'] ?? '') }}</textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label>Judul Informasi Kontak</label>
                    <input type="text" class="form-control" name="contact_info_heading" value="{{ old('contact_info_heading', $settings['contactInfoHeading'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Deskripsi Informasi Kontak</label>
                    <textarea class="form-control" name="contact_info_description" rows="3">{{ old('contact_info_description', $settings['contactInfoDescription'] ?? '') }}</textarea>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $settings['email'] ?? '') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="address" rows="3">{{ old('address', $settings['address'] ?? '') }}</textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label>Gambar Halaman Sukses</label>
                    <input type="file" class="form-control" name="success_image" accept="image/*">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                    @if(isset($settings['successImage']) && $settings['successImage'])
                        <div class="mt-2">
                            <label>Gambar Saat Ini:</label><br>
                            <img src="{{ config('services.adonis.public_url') }}/{{ $settings['successImage'] }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection