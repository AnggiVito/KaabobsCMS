@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><div class="card-title">Form Tambah Lokasi</div></div>
                <form action="{{ route('lokasi.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @include('lokasi._form-fields')
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('lokasi.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection