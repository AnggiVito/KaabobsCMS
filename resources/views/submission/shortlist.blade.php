@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">{{ $subTitle ?? 'Kandidat Shortlist' }}</h4>
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
                            <th>Posisi Dilamar</th>
                            <th>Status</th>
                            <th style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $submission)
                        <tr>
                            <td>{{ $submission['firstName'] }} {{ $submission['lastName'] }}</td>
                            <td>{{ $submission['position'] ? $submission['position']['namaposisi'] : 'N/A' }}</td>
                            <td>
                                <span class="badge badge-warning">{{ $submission['statusText'] }}</span>
                            </td>
                            <td class="text-center">
                                <div class="form-button-action justify-content-center">
                                    <a href="{{ route('submission.show', $submission['id']) }}" class="btn btn-link btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>

                                    <form action="{{ route('submission.updateStatus', $submission['id']) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="3">
                                        <button type="submit" class="btn btn-link btn-success" title="Pindah ke Interview">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada kandidat yang di-shortlist.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection