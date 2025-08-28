@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="card"><div class="card-header"><div class="card-title">{{ $subTitle }}</div></div>
        <form action="{{ route('menu-favorit.update', $item['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-body">@include('menu-favorit._form-fields', ['item' => $item])</div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('menu-favorit.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection