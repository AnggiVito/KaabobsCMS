@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title mb-0">{{ $subTitle ?? 'Kandidat Shortlist' }}</h4>
                <a href="{{ route('submission.index') }}" class="btn btn-outline-secondary btn-round ms-auto">
                    Kembali ke Semua Lamaran
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-semibold">Nama Pelamar</th>
                            <th class="fw-semibold">Posisi Dilamar</th>
                            <th class="fw-semibold">Status</th>
                            <th class="text-center fw-semibold" style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $submission)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm bg-light border me-3">
                                        <span class="text-primary fw-bold">
                                            {{ strtoupper(substr($submission['firstName'], 0, 1)) }}{{ strtoupper(substr($submission['lastName'], 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-dark">{{ $submission['firstName'] }} {{ $submission['lastName'] }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($submission['position'])
                                    <span class="badge bg-light text-primary border border-primary">
                                        {{ $submission['position']['namaposisi'] }}
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted border">N/A</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-warning border border-warning">{{ $submission['statusText'] }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('submission.show', $submission['id']) }}" 
                                        class="btn btn-sm btn-outline-primary rounded-pill" 
                                        title="Lihat Detail">
                                        Detail
                                    </a>

                                    <form action="{{ route('submission.updateStatus', $submission['id']) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="3">
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-success rounded-pill" 
                                                title="Pindah ke Interview">
                                            Interview
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="empty-state">
                                    <h5 class="text-muted fw-normal">Belum ada kandidat yang di-shortlist.</h5>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
    
    .table {
        margin-bottom: 0;
        font-size: 0.925rem;
    }
    
    .table thead th {
        border-top: none;
        border-bottom: 2px solid #e9ecef;
        padding: 1rem 0.875rem;
        background: #f8f9fa !important;
        color: #6c757d;
        font-size: 0.875rem;
    }
    
    .table tbody td {
        padding: 1rem 0.875rem;
        border-top: 1px solid #f1f3f4;
        vertical-align: middle;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.03);
        transition: background-color 0.2s ease;
    }
    
    .avatar {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 0.825rem;
    }
    
    .badge {
        font-size: 0.8rem;
        font-weight: 500;
        padding: 0.5rem 0.875rem;
        border-radius: 6px;
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
    
    .btn-sm.rounded-pill {
        padding: 0.375rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.8rem;
    }
    
    .btn-outline-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(0, 123, 255, 0.25);
    }
    
    .btn-outline-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(40, 167, 69, 0.25);
    }
    
    .empty-state {
        padding: 2rem;
    }
    
    .table-responsive {
        border-radius: 8px;
    }
    
    .gap-2 {
        gap: 0.5rem;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        padding: 0.375rem 0.75rem;
        color: #5a5c69;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px;
        margin: 0 2px;
        color: #6c757d !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #e9ecef !important;
        border-color: #e9ecef !important;
        color: #495057 !important;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #007bff !important;
        border-color: #007bff !important;
        color: white !important;
    }
    
    .dataTables_wrapper .dataTables_info {
        color: #6c757d;
        font-size: 0.875rem;
        padding-top: 0.75rem;
    }
    
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#add-row').DataTable({ 
            "pageLength": 10, 
            "order": [[ 0, "asc" ]],
            "language": {
                "lengthMenu": "Tampilkan _MENU_ entri",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "infoFiltered": "(disaring dari _MAX_ total entri)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>
@endpush