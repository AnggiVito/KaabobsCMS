@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h4 class="card-title mb-1">{{ $subTitle ?? 'Kandidat Interview' }}</h4>
                    <p class="card-subtitle text-muted mb-0">Daftar kandidat yang lolos ke tahap interview</p>
                </div>
                <a href="{{ route('submission.index') }}" class="btn btn-outline-secondary btn-round ms-auto">
                    <i class="fa fa-arrow-left me-2"></i>
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
                            <th class="fw-semibold">Email</th>
                            <th class="fw-semibold">Posisi Dilamar</th>
                            <th class="fw-semibold">Status</th>
                            <th class="text-center fw-semibold" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($submissions as $submission)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm bg-gradient-primary me-3">
                                        <span class="text-white fw-bold">
                                            {{ strtoupper(substr($submission['firstName'], 0, 1)) }}{{ strtoupper(substr($submission['lastName'], 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-dark fw-semibold">{{ $submission['firstName'] }} {{ $submission['lastName'] }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted">{{ $submission['email'] }}</span>
                            </td>
                            <td>
                                @if($submission['position'])
                                    <span class="badge bg-light text-primary border border-primary fw-medium">
                                        {{ $submission['position']['namaposisi'] }}
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted border fw-medium">N/A</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success-subtle text-success border border-success fw-medium">
                                    <i class="fa fa-check-circle me-1"></i>
                                    {{ $submission['statusText'] }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('submission.show', $submission['id']) }}" 
                                    class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                                    title="Lihat Detail Kandidat">
                                    <i class="fa fa-eye me-1"></i>
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="mb-3">
                                        <i class="fa fa-users text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mb-2">Belum ada kandidat yang masuk tahap interview</h5>
                                    <p class="text-muted small mb-0">Kandidat yang lolos shortlist akan muncul di sini</p>
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
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
    }
    
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        padding: 2rem;
        border-radius: 16px 16px 0 0;
    }
    
    .card-body {
        padding: 2rem;
        background: #ffffff;
        border-radius: 0 0 16px 16px;
    }
    
    .card-title {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.375rem;
        letter-spacing: -0.025em;
    }
    
    .card-subtitle {
        font-size: 0.875rem;
        font-weight: 400;
    }
    
    .table {
        margin-bottom: 0;
        font-size: 0.925rem;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .table thead th {
        border-top: none;
        border-bottom: 2px solid #e9ecef;
        padding: 1.25rem 1rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        color: #495057;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }
    
    .table thead th:first-child {
        border-radius: 12px 0 0 0;
    }
    
    .table thead th:last-child {
        border-radius: 0 12px 0 0;
    }
    
    .table tbody td {
        padding: 1.25rem 1rem;
        border-top: 1px solid #f1f3f4;
        vertical-align: middle;
        background: #ffffff;
        transition: all 0.3s ease;
    }
    
    .table-hover tbody tr {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .table-hover tbody tr:hover {
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.04) 0%, rgba(0, 123, 255, 0.02) 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .table-hover tbody tr:hover td {
        background: transparent;
    }
    
    .avatar {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 0.875rem;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: 2px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.25);
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
    }
    
    .badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        letter-spacing: 0.25px;
    }
    
    .bg-success-subtle {
        background-color: rgba(25, 135, 84, 0.1) !important;
    }
    
    .text-success {
        color: #198754 !important;
    }
    
    .border-success {
        border-color: rgba(25, 135, 84, 0.3) !important;
    }
    
    .btn-round {
        border-radius: 25px;
        padding: 0.625rem 1.5rem;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid;
    }
    
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
        background: #ffffff;
    }
    
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.25);
        background: #6c757d;
        color: #ffffff;
    }
    
    .btn-sm.rounded-pill {
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.8rem;
        border: 2px solid;
    }
    
    .btn-outline-primary {
        color: #007bff;
        border-color: rgba(0, 123, 255, 0.5);
        background: rgba(0, 123, 255, 0.02);
    }
    
    .btn-outline-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: #ffffff;
        border-color: #007bff;
    }
    
    .empty-state {
        padding: 3rem 2rem;
        text-align: center;
    }
    
    .empty-state i {
        margin-bottom: 1.5rem;
        opacity: 0.6;
        animation: pulse 2s ease-in-out infinite alternate;
    }
    
    @keyframes pulse {
        0% { opacity: 0.4; }
        100% { opacity: 0.8; }
    }
    
    .table-responsive {
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .dataTables_wrapper {
        padding: 1rem 0;
    }
    
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid #e3e6f0;
        border-radius: 10px;
        padding: 0.5rem 0.875rem;
        color: #5a5c69;
        background: #ffffff;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        outline: none;
    }
    
    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        color: #495057;
        font-weight: 600;
        margin-bottom: 0;
        font-size: 0.875rem;
    }
    
    .dataTables_wrapper .dataTables_filter {
        text-align: right;
    }
    
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1.5rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        margin: 0 3px;
        color: #6c757d !important;
        border: 2px solid transparent !important;
        padding: 0.5rem 0.875rem !important;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: linear-gradient(135deg, #e9ecef 0%, #f8f9fa 100%) !important;
        border-color: #dee2e6 !important;
        color: #495057 !important;
        transform: translateY(-1px);
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
        border-color: #007bff !important;
        color: white !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }
    
    .dataTables_wrapper .dataTables_info {
        color: #6c757d;
        font-size: 0.875rem;
        padding-top: 1rem;
        font-weight: 500;
    }

    .avatar {
        position: relative;
        overflow: hidden;
    }
    
    .avatar::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }
    
    .table-hover tbody tr:hover .avatar::before {
        left: 100%;
    }

    .badge {
        position: relative;
        overflow: hidden;
        text-shadow: none;
    }
    
    .badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .table-hover tbody tr:hover .badge::before {
        left: 100%;
    }

    .btn {
        position: relative;
        overflow: hidden;
        font-weight: 600;
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transition: all 0.3s ease;
        transform: translate(-50%, -50%);
    }
    
    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    @keyframes shimmer {
        0% { background-position: -200px 0; }
        100% { background-position: calc(200px + 100%) 0; }
    }
    
    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200px 100%;
        animation: shimmer 1.5s infinite;
    }

    .card {
        animation: fadeInUp 0.6s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .table tbody tr {
        animation: fadeInRow 0.4s ease-out backwards;
    }
    
    .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .table tbody tr:nth-child(5) { animation-delay: 0.5s; }
    
    @keyframes fadeInRow {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .badge.bg-success-subtle {
        background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(25, 135, 84, 0.05) 100%) !important;
        border: 2px solid rgba(25, 135, 84, 0.2) !important;
        box-shadow: 0 2px 8px rgba(25, 135, 84, 0.1);
    }

    .badge.bg-light.text-primary {
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.08) 0%, rgba(0, 123, 255, 0.04) 100%) !important;
        border: 2px solid rgba(0, 123, 255, 0.2) !important;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.1);
    }

    @media (max-width: 768px) {
        .page-inner {
            padding: 1rem;
        }
        
        .card-header {
            padding: 1.5rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .btn-round {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }
        
        .table thead th,
        .table tbody td {
            padding: 1rem 0.75rem;
        }
        
        .avatar {
            width: 36px;
            height: 36px;
            font-size: 0.8rem;
        }
    }

    @media (prefers-color-scheme: dark) {
        .card {
            background: rgba(33, 37, 41, 0.95);
        }
        
        .card-header {
            background: linear-gradient(135deg, #212529 0%, #343a40 100%);
        }
        
        .card-body {
            background: #212529;
        }
        
        .table thead th {
            background: linear-gradient(135deg, #343a40 0%, #495057 100%) !important;
            color: #adb5bd;
        }
        
        .table tbody td {
            background: #212529;
            border-color: #495057;
            color: #adb5bd;
        }
        
        .table-hover tbody tr:hover {
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.1) 0%, rgba(0, 123, 255, 0.05) 100%);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#add-row').DataTable({ 
            "pageLength": 10, 
            "order": [[ 0, "asc" ]],
            "responsive": true,
            "autoWidth": false,
            "language": {
                "lengthMenu": "Tampilkan _MENU_ kandidat per halaman",
                "zeroRecords": "Tidak ada kandidat yang ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ kandidat",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 kandidat",
                "infoFiltered": "(disaring dari _MAX_ total kandidat)",
                "search": "Cari kandidat:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir", 
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
                "emptyTable": "Belum ada kandidat yang masuk tahap interview"
            },
            "dom": '<"row"<"col-sm-6"l><"col-sm-6"f>>t<"row"<"col-sm-6"i><"col-sm-6"p>>',
            "drawCallback": function(settings) {
                $(this).find('tbody tr').each(function(index) {
                    $(this).css({
                        'animation-delay': (index * 0.05) + 's',
                        'animation': 'fadeInRow 0.4s ease-out backwards'
                    });
                });
            }
        });
        
        $('#add-row tbody').on('mouseenter', 'tr', function() {
            $(this).find('.btn').addClass('btn-hover-effect');
        }).on('mouseleave', 'tr', function() {
            $(this).find('.btn').removeClass('btn-hover-effect');
        });
        
        $('.btn-outline-primary').on('click', function() {
            const $btn = $(this);
            const originalText = $btn.html();
            
            $btn.html('<i class="fa fa-spinner fa-spin me-1"></i>Loading...');
            $btn.prop('disabled', true);
            
            setTimeout(() => {
                $btn.html(originalText);
                $btn.prop('disabled', false);
            }, 1000);
        });
    });
</script>
@endpush