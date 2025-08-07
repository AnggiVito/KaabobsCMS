@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header"><div class="card-title">{{ $subTitle }}</div></div>
        {{-- PENTING: Tambahkan enctype untuk upload file --}}
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">@include('menu._form-fields')</div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('menu.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection