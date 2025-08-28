@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="card"><div class="card-header"><div class="card-title">{{ $subTitle }}</div></div>
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">@include('gallery._form-fields')</div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('gallery.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection