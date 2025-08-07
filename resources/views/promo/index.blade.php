@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">{{ $subTitle ?? 'Daftar Promo' }}</h4>
                <a href="{{ route('promo.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah Promo</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Judul Promo</th>
                            <th>Berakhir</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promos as $promo)
                        <tr>
                            <td><img src="{{ config('services.adonis.public_url') }}/{{ $promo['image'] }}" alt="{{ $promo['title'] }}" height="100"></td>
                            <td>{{ $promo['title'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($promo['expired'])->format('d M Y') }}</td>
                            <td class="text-center">
                                <div class="form-button-action justify-content-center">
                                    <a href="{{ route('promo.edit', $promo['id']) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('promo.destroy', $promo['id']) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Hapus promo ini?')"><i class="fa fa-times"></i></button>
                                    </form>
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
@endsection