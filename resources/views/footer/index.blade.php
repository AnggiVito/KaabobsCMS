@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
    </div>
    @endif

    <form action="{{ route('footer.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">{{ $subTitle }}</h4>
                    <button type="submit" class="btn btn-success btn-round ms-auto"><i class="fa fa-check"></i> Simpan Perubahan</button>
                </div>
            </div>
            <div class="card-body">
                <h5>Informasi Umum</h5>
                <div class="form-group">
                    <label>Logo Footer</label>
                    <input type="file" class="form-control" name="logo_image">
                    @if(isset($settings['logoImage']))<img src="{{ config('services.adonis.public_url') }}/{{ $settings['logoImage'] }}" class="img-thumbnail mt-2" style="max-height: 50px; background: #333;">@endif
                </div>
                <div class="form-group"><label>Nama Perusahaan</label><input type="text" class="form-control" name="company_name" value="{{ old('company_name', $settings['companyName'] ?? '') }}"></div>
                <div class="form-group"><label>Alamat Perusahaan</label><textarea class="form-control" name="company_address">{{ old('company_address', $settings['companyAddress'] ?? '') }}</textarea></div>
                <div class="form-group"><label>Email Perusahaan</label><input type="email" class="form-control" name="company_email" value="{{ old('company_email', $settings['companyEmail'] ?? '') }}"></div>
                <div class="form-group"><label>Telepon Perusahaan</label><input type="text" class="form-control" name="company_phone" value="{{ old('company_phone', $settings['companyPhone'] ?? '') }}"></div>
                <div class="form-group"><label>Teks Sign Up</label><input type="text" class="form-control" name="sign_up_text" value="{{ old('sign_up_text', $settings['signUpText'] ?? '') }}"></div>
                
                <hr>

                <h5>Navigasi Links (Maksimal 5)</h5>
                @for ($i = 0; $i < 5; $i++)
                <div class="row mb-2">
                    <div class="col"><input type="text" name="nav_links[{{$i}}][label]" class="form-control" placeholder="Label, cth: Tentang Kami" value="{{ old('nav_links.'.$i.'.label', $settings['navLinks'][$i]['label'] ?? '') }}"></div>
                    <div class="col"><input type="text" name="nav_links[{{$i}}][route]" class="form-control" placeholder="Route, cth: /AboutUs" value="{{ old('nav_links.'.$i.'.route', $settings['navLinks'][$i]['route'] ?? '') }}"></div>
                </div>
                @endfor
                <small class="form-text text-muted">Kosongkan field untuk menghapus atau tidak menampilkan link.</small>

                <hr>

                <h5>Social Media Links (Maksimal 4)</h5>
                @for ($i = 0; $i < 4; $i++)
                <div class="row mb-2">
                    <div class="col"><input type="text" name="social_media_links[{{$i}}][name]" class="form-control" placeholder="Nama, cth: Instagram" value="{{ old('social_media_links.'.$i.'.name', $settings['socialMediaLinks'][$i]['name'] ?? '') }}"></div>
                    <div class="col"><input type="url" name="social_media_links[{{$i}}][url]" class="form-control" placeholder="URL Lengkap" value="{{ old('social_media_links.'.$i.'.url', $settings['socialMediaLinks'][$i]['url'] ?? '') }}"></div>
                </div>
                @endfor
                <small class="form-text text-muted">Kosongkan field untuk menghapus atau tidak menampilkan link.</small>
            </div>
        </div>
    </form>
</div>
@endsection