@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h6 class="op-7 mb-2">Selamat Datang, {{ Auth::user()->name }}!</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-primary card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center"><i class="fas fa-briefcase"></i></div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Lowongan</p>
                                <h4 class="card-title">{{ $totalKarier ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-info card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center"><i class="fas fa-map-marker-alt"></i></div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total Lokasi</p>
                                <h4 class="card-title">{{ $totalLokasi ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-success card-round">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center"><i class="fas fa-question-circle"></i></div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category">Total FAQ</p>
                                <h4 class="card-title">{{ $totalFaq ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lowongan Terbaru</h4>
                        <a href="{{ route('karier.create') }}" class="btn btn-primary btn-round btn-sm ms-auto">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse ($latestKariers as $karier)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $karier['namaposisi'] }} - {{ $karier['kota'] }}</span>
                                <a href="{{ route('karier.edit', $karier['id']) }}" class="btn btn-xs btn-secondary">Edit</a>
                            </li>
                        @empty
                            <li class="list-group-item">Belum ada data.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lokasi Terbaru</h4>
                        <a href="{{ route('lokasi.create') }}" class="btn btn-primary btn-round btn-sm ms-auto">
                            <i class="fa fa-plus"></i>
                            Tambah
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse ($latestLocations as $location)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $location['name'] }} - {{ $location['regionName'] }}</span>
                                <a href="{{ route('lokasi.edit', $location['id']) }}" class="btn btn-xs btn-secondary">Edit</a>
                            </li>
                        @empty
                            <li class="list-group-item">Belum ada data.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection