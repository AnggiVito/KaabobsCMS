@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="card"><div class="card-header"><div class="card-title">Tambah Gambar Dropdown</div></div>
        <form action="{{ route('navbar.thumb.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @if ($errors->any())<div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                <div class="form-group"><label>Urutan Tampil</label><input type="number" class="form-control" name="sort_order" value=""></div>
                <div class="form-group"><label>File Gambar (PNG/WEBP)</label><input type="file" class="form-control" name="image" accept="image/*" required></div>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('navbar.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection