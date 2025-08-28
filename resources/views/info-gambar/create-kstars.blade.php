@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Tambah Gambar K-Stars</div>
        </div>
        <form action="{{ route('k-stars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @include('manajemen-home.info-gambar._form-fields-kstars')
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('info-gambar.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection