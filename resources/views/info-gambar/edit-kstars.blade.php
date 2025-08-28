@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Gambar K-Stars</div>
        </div>
        <form action="{{ route('k-stars.update', $item['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Menggunakan POST untuk konsistensi dengan route dan file upload --}}
            <div class="card-body">
                @include('manajemen-home.info-gambar._form-fields-kstars', ['item' => $item])
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('info-gambar.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection