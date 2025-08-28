@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="card"><div class="card-header"><div class="card-title">{{ $subTitle }}</div></div>
        <form action="{{ route('menu-favorit.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">@include('menu-favorit._form-fields')</div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('menu-favorit.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection