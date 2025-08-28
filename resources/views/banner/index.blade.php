@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
        </div>
    @endif

    <form action="{{ route('banner.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">{{ $subTitle }}</h4>
                    <button type="submit" class="btn btn-success btn-round ms-auto">
                        <i class="fa fa-check"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p>Atur gambar yang akan muncul di bagian paling atas (banner section) pada halaman depan website.</p>
                
                <div class="form-group">

                    <label for="heroImage">Upload Gambar Banner Baru</label>
                    <input type="file" class="form-control" name="heroImage" accept="image/*">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>

                    @if($settings->has('heroImage') && $settings->get('heroImage') != '')
                    <div class="mt-3">
                        <label>Gambar Hero Saat Ini:</label><br>
                        <img src="{{ config('services.adonis.public_url') }}/{{ $settings->get('heroImage') }}" 
                            alt="Hero Image" class="img-thumbnail" style="max-height: 200px;">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection