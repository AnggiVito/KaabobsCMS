@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $subTitle ?? 'Daftar FAQ' }}</h4>
                        <a href="{{ route('faq.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah FAQ</a>
                    </div>
                </div>
                <div class="card-body justify">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $faq['question'] }}</td>
                                    <td>{{ Str::limit($faq['answer'], 80) }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action justify-content-center">
                                            <a href="{{ route('faq.edit', $faq['id']) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-link btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="{{ route('faq.destroy', $faq['id']) }}"><i class="fa fa-times"></i></button>
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
                <p>Anda yakin ingin menghapus data ini?</p>
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
        $('.btn-delete').on('click', function() {
            let url = $(this).data('url');
            $('#deleteForm').attr('action', url);
        });
    });
</script>
@endpush