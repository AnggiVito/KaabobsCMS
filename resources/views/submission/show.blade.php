@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">{{ $subTitle }}: {{ $submission['firstName'] }} {{ $submission['lastName'] }}</h4>
                <a href="{{ route('submission.index') }}" class="btn btn-secondary btn-round ms-auto">
                    <i class="fa fa-arrow-left"></i>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Data Diri Pelamar</h5>
                    <dl class="row">
                        <dt class="col-sm-4">Nama Lengkap</dt>
                        <dd class="col-sm-8">{{ $submission['firstName'] }} {{ $submission['lastName'] }}</dd>
                        <dt class="col-sm-4">Posisi Dilamar</dt>
                        <dd class="col-sm-8">{{ $submission['position'] ? $submission['position']['namaposisi'] : 'N/A' }}</dd>
                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $submission['email'] }}</dd>
                        <dt class="col-sm-4">No. Telepon</dt>
                        <dd class="col-sm-8">{{ $submission['phoneNumber'] }}</dd>
                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">{{ $submission['address'] }}</dd>
                        <dt class="col-sm-4">LinkedIn</dt>
                        <dd class="col-sm-8"><a href="{{ $submission['linkedin'] }}" target="_blank">{{ $submission['linkedin'] }}</a></dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <h5>Informasi Tambahan</h5>
                    <dl class="row">
                        <dt class="col-sm-4">Jenis Kelamin</dt>
                        <dd class="col-sm-8">{{ $submission['gender'] }}</dd>
                        <dt class="col-sm-4">Pendidikan</dt>
                        <dd class="col-sm-8">{{ $submission['education'] }}</dd>
                        <dt class="col-sm-4">Status Pernikahan</dt>
                        <dd class="col-sm-8">{{ $submission['maritalStatus'] }}</dd>
                        <dt class="col-sm-4">Ekspektasi Gaji</dt>
                        <dd class="col-sm-8">Rp {{ number_format($submission['expectedSalary'], 0, ',', '.') }}</dd>
                    </dl>
                </div>
            </div>
            <hr>
            <h5>Dokumen Terlampir</h5>
            <div class="mt-3">
                <a href="{{ config('services.adonis.public_url') }}/{{ $submission['cvPath'] }}" target="_blank" class="btn btn-primary me-2">
                    <i class="fa fa-file-pdf"></i> Lihat CV
                </a>
                <a href="{{ config('services.adonis.public_url') }}/{{ $submission['ktpPath'] }}" target="_blank" class="btn btn-info me-2">
                    <i class="fa fa-id-card"></i> Lihat KTP
                </a>
                <a href="{{ config('services.adonis.public_url') }}/{{ $submission['npwpPath'] }}" target="_blank" class="btn btn-success">
                    <i class="fa fa-file-alt"></i> Lihat NPWP
                </a>
            </div>
        </div>
    </div>
</div>
@endsection