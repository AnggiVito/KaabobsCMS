@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="card"><div class="card-header"><div class="card-title">Tambah Link Dropdown</div></div>
        <form action="{{ route('navbar.link.store') }}" method="POST">
            @csrf
            <div class="card-body">
                @if ($errors->any())<div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                <div class="form-group"><label>Label</label><input type="text" class="form-control" name="title" placeholder="Contoh: Kebab" required></div>
                <div class="form-group"><label>Route/URL</label><input type="text" class="form-control" name="link_url" placeholder="Contoh: /Menu" required></div>
                <div class="form-group"><label>Urutan Tampil</label><input type="number" class="form-control" name="sort_order" value="0"></div>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('navbar.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection