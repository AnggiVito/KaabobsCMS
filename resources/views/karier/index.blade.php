@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $subTitle ?? 'Daftar Lowongan' }}</h4>
                        <a href="{{ route('karier.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Tambah Lowongan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Posisi</th>
                                    <th>Kota</th>
                                    <th>Tipe Kerja</th>
                                    <th>Tanggal Posting</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kariers as $karier)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $karier['namaposisi'] }}</td>
                                    <td>{{ $karier['kota'] }}</td>
                                    <td>{{ $karier['worktype'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($karier['posting'])->format('d M Y') }}</td>
                                    <td class="text-center"> 
                                        <div class="form-button-action justify-content-center">
                                            <a href="{{ route('karier.edit', $karier['id']) }}" class="btn btn-link btn-primary" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-link btn-danger btn-delete" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal" 
                                                    data-url="{{ route('karier.destroy', $karier['id']) }}"
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data ini? Proses ini tidak bisa diurungkan.</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#add-row').DataTable({ "pageLength": 10 });

        $('[data-bs-toggle="tooltip"]').tooltip();

        $('.btn-delete').on('click', function() {
            let url = $(this).data('url');
            $('#deleteForm').attr('action', url);
        });
    });
</script>
@endpush