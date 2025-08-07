@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $subTitle ?? 'Daftar Lamaran' }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pelamar</th>
                            <th>Email</th>
                            <th>Posisi Dilamar</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $submission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $submission['firstName'] }} {{ $submission['lastName'] }}</td>
                            <td>{{ $submission['email'] }}</td>
                            {{-- Akses data relasi 'position' --}}
                            <td>{{ $submission['position'] ? $submission['position']['namaposisi'] : 'N/A' }}</td>
                            <td class="text-center">
                                <a href="{{ route('submission.show', $submission['id']) }}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data lamaran yang masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#add-row').DataTable({ "pageLength": 10, "order": [[ 4, "desc" ]] });
    });
</script>
@endpush