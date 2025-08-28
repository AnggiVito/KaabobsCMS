@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if ($errors->any())<div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif

    <form action="{{ route('tentang-kami.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">{{ $subTitle }}</h4>
                    <button type="submit" class="btn btn-success btn-round ms-auto"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </div>
            <div class="card-body">
                {{-- Gunakan akses array dan camelCase sesuai response API --}}
                <div class="form-group"><label>Jumlah Toko</label><input type="text" class="form-control" name="store_count" value="{{ old('store_count', $settings['storeCount'] ?? '') }}"></div>
                <div class="form-group"><label>Deskripsi Toko</label><textarea class="form-control" name="store_description">{{ old('store_description', $settings['storeDescription'] ?? '') }}</textarea></div>
                <div class="form-group"><label>Judul Rating</label><input type="text" class="form-control" name="rating_title" value="{{ old('rating_title', $settings['ratingTitle'] ?? '') }}"></div>
                <div class="form-group"><label>Deskripsi Rating</label><textarea class="form-control" name="rating_description">{{ old('rating_description', $settings['ratingDescription'] ?? '') }}</textarea></div>
                <hr>
                <div class="form-group"><label>Judul Tentang Kami</label><input type="text" class="form-control" name="about_us_title" value="{{ old('about_us_title', $settings['aboutUsTitle'] ?? '') }}"></div>
                <div class="form-group"><label>Isi Paragraf 1</label><textarea class="form-control" name="about_us_body1" rows="4">{{ old('about_us_body1', $settings['aboutUsBody1'] ?? '') }}</textarea></div>
                <div class="form-group"><label>Isi Paragraf 2</label><textarea class="form-control" name="about_us_body2" rows="4">{{ old('about_us_body2', $settings['aboutUsBody2'] ?? '') }}</textarea></div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gambar Utama</label>
                            <input type="file" class="form-control" name="img_utama_src">
                            @if(isset($settings['imgUtamaSrc']))<img src="{{ config('services.adonis.public_url') }}/{{ $settings['imgUtamaSrc'] }}" class="img-thumbnail mt-2" style="max-height: 150px;">@endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gambar Sosmed</label>
                            <input type="file" class="form-control" name="img_sosmed1_src">
                            @if(isset($settings['imgSosmed1Src']))<img src="{{ config('services.adonis.public_url') }}/{{ $settings['imgSosmed1Src'] }}" class="img-thumbnail mt-2" style="max-height: 150px;">@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection