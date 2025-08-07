@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Edit Lowongan</div>
                </div>
                <form action="{{ route('karier.update', $karier['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @include('karier._form-fields', ['karier' => $karier])
                    </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('karier.index') }}" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection