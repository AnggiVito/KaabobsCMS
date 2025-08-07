@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Tambah Lowongan</div>
                </div>
                <form action="{{ route('karier.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @include('karier._form-fields')
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('karier.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection