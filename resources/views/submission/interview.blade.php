@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">{{ $subTitle ?? 'Kandidat Interview' }}</h4>
                <a href="{{ route('submission.index') }}" class="btn btn-secondary btn-round ms-auto">
                    <i class="fa fa-arrow-left"></i>
                    Kembali ke Semua Lamaran
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama Pelamar</th>
                            <th>Email</th>
                            <th>Posisi Dilamar</th>
                            <th>Status</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $submission)
                        <tr>
                            <td>{{ $submission['firstName'] }} {{ $submission['lastName'] }}</td>
                            <td>{{ $submission['email'] }}</td>
                            <td>{{ $submission['position'] ? $submission['position']['namaposisi'] : 'N/A' }}</td>
                            <td>
                                <span class="badge badge-success">{{ $submission['statusText'] }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('submission.show', $submission['id']) }}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada kandidat yang masuk tahap interview.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection