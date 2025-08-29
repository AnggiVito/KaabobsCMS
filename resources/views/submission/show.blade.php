@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <div>
                        <h4 class="card-title mb-0">{{ $subTitle }}: {{ $submission['firstName'] }} {{ $submission['lastName'] }}</h4>
                        <small class="text-muted">ID Lamaran: {{ str_pad($submission['id'], 4, '0', STR_PAD_LEFT) }}</small>
                    </div>
                </div>
                <a href="{{ route('submission.index') }}" class="btn btn-outline-secondary btn-round ms-auto">
                    Kembali ke Daftar
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-section">
                        <h5 class="section-title">
                            Data Diri Pelamar
                        </h5>
                        <div class="info-card">
                            <dl class="row mb-0">
                                <dt class="col-sm-5 text-muted">Nama Lengkap</dt>
                                <dd class="col-sm-7 fw-semibold">{{ $submission['firstName'] }} {{ $submission['lastName'] }}</dd>
                                
                                <dt class="col-sm-5 text-muted">Posisi Dilamar</dt>
                                <dd class="col-sm-7">
                                    @if($submission['position'])
                                        <span class="badge bg-light text-primary border border-primary">
                                            {{ $submission['position']['namaposisi'] }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-muted border">N/A</span>
                                    @endif
                                </dd>
                                
                                <dt class="col-sm-5 text-muted">Email</dt>
                                <dd class="col-sm-7">
                                    <a href="mailto:{{ $submission['email'] }}" class="text-decoration-none">
                                        {{ $submission['email'] }}
                                    </a>
                                </dd>
                                
                                <dt class="col-sm-5 text-muted">No. Telepon</dt>
                                <dd class="col-sm-7">
                                    <a href="tel:{{ $submission['phoneNumber'] }}" class="text-decoration-none">
                                        {{ $submission['phoneNumber'] }}
                                    </a>
                                </dd>
                                
                                <dt class="col-sm-5 text-muted">Alamat</dt>
                                <dd class="col-sm-7">{{ $submission['address'] }}</dd>
                                
                                @if(!empty($submission['linkedin']))
                                <dt class="col-sm-5 text-muted">LinkedIn</dt>
                                <dd class="col-sm-7">
                                    <a href="{{ $submission['linkedin'] }}" target="_blank" class="text-decoration-none">
                                        {{ $submission['linkedin'] }}
                                    </a>
                                </dd>
                                @endif
                            </dl>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="info-section">
                        <h5 class="section-title">
                            Informasi Tambahan
                        </h5>
                        <div class="info-card">
                            <dl class="row mb-0">
                                <dt class="col-sm-5 text-muted">Jenis Kelamin</dt>
                                <dd class="col-sm-7">{{ $submission['gender'] }}</dd>
                                
                                <dt class="col-sm-5 text-muted">Pendidikan</dt>
                                <dd class="col-sm-7">{{ $submission['education'] }}</dd>
                                
                                <dt class="col-sm-5 text-muted">Status Pernikahan</dt>
                                <dd class="col-sm-7">{{ $submission['maritalStatus'] }}</dd>
                                
                                <dt class="col-sm-5 text-muted">Ekspektasi Gaji</dt>
                                <dd class="col-sm-7">
                                    <span class="fw-semibold text-success">
                                        Rp {{ number_format($submission['expectedSalary'], 0, ',', '.') }}
                                    </span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-section mb-4">
                <h5 class="section-title">
                    Informasi Pekerjaan
                </h5>
                <div class="info-card">
                    <dl class="row mb-0">
                        <dt class="col-sm-3 text-muted">Pekerjaan Terakhir</dt>
                        <dd class="col-sm-9">{{ $submission['previousJob'] }}</dd>
                        
                        <dt class="col-sm-3 text-muted">Alasan Tertarik</dt>
                        <dd class="col-sm-9 fst-italic">{{ $submission['whyKabobs'] }}</dd>
                        
                        <dt class="col-sm-3 text-muted">Alasan Keluar</dt>
                        <dd class="col-sm-9">{{ $submission['reasonForLeaving'] }}</dd>
                    </dl>
                </div>
            </div>

            <div class="info-section">
                <h5 class="section-title">
                    Dokumen Terlampir
                </h5>
                <div class="info-card">
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ config('services.adonis.public_url') }}/{{ $submission['cvPath'] }}" 
                            target="_blank" 
                            class="btn btn-outline-danger btn-document">
                            <div>
                                <div class="fw-semibold">Curriculum Vitae</div>
                                <small class="text-muted">PDF Document</small>
                            </div>
                        </a>
                        
                        <a href="{{ config('services.adonis.public_url') }}/{{ $submission['ktpPath'] }}" 
                            target="_blank" 
                            class="btn btn-outline-info btn-document">
                            <div>
                                <div class="fw-semibold">Kartu Identitas</div>
                                <small class="text-muted">KTP Document</small>
                            </div>
                        </a>
                        
                        <a href="{{ config('services.adonis.public_url') }}/{{ $submission['npwpPath'] }}" 
                            target="_blank" 
                            class="btn btn-outline-success btn-document">
                            <div>
                                <div class="fw-semibold">NPWP</div>
                                <small class="text-muted">Tax Document</small>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Status Action -->
                    <div class="mt-4 pt-3 border-top">
                        @if($submission['status'] == 1)
                            <form action="{{ route('submission.updateStatus', $submission['id']) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="2">
                                <button type="submit" class="btn btn-outline-warning">
                                    Masukkan ke Shortlist
                                </button>
                            </form>
                        @else
                            <span class="badge bg-light text-warning border border-warning px-3 py-2">
                                Sudah di-Shortlist
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .page-inner {
        padding: 2rem 1.5rem;
    }
    
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }
    
    .card-header {
        background: #f8f9fa;
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
        border-radius: 12px 12px 0 0;
    }
    
    .card-body {
        padding: 2rem;
    }
    
    .card-title {
        color: #495057;
        font-weight: 600;
        font-size: 1.25rem;
    }
    
    .avatar {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 1rem;
    }
    
    .btn-round {
        border-radius: 25px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    
    .btn-outline-secondary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.2);
    }
    
    .section-title {
        color: #495057;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f3f4;
    }
    
    .info-section {
        margin-bottom: 2rem;
    }
    
    .info-card {
        background: #fafbfc;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 1.5rem;
    }
    
    .info-card dl {
        margin-bottom: 0;
    }
    
    .info-card dt {
        font-weight: 500;
        font-size: 0.875rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }
    
    .info-card dd {
        color: #495057;
        margin-bottom: 1rem;
        font-size: 0.925rem;
    }
    
    .info-card dd:last-child {
        margin-bottom: 0;
    }
    
    .btn-document {
        display: flex;
        align-items: center;
        padding: 1rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        background: #fff;
        min-width: 180px;
    }
    
    .btn-document:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .badge {
        font-size: 0.875rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 6px;
    }
    
    .border-top {
        border-color: #e9ecef !important;
    }
    
    .btn-outline-warning {
        color: #856404;
        border-color: #ffeaa7;
        transition: all 0.3s ease;
    }
    
    .btn-outline-warning:hover {
        background-color: #fff3cd;
        border-color: #ffeb3b;
        color: #856404;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.2);
    }
    
    .text-decoration-none:hover {
        text-decoration: none !important;
    }
    
    a[href^="mailto:"]:hover,
    a[href^="tel:"]:hover {
        opacity: 0.8;
    }
    
    hr {
        border-color: #e9ecef;
        opacity: 0.6;
        margin: 2rem 0;
    }
</style>
@endpush