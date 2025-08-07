@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">{{ $subTitle ?? 'Daftar Menu' }}</h4>
                <a href="{{ route('menu.create') }}" class="btn btn-primary btn-round ms-auto"><i class="fa fa-plus"></i> Tambah Menu</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Menu</th>
                            <th>Kategori</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                        <tr>
                            <td><img src="{{ config('services.adonis.public_url') }}/{{ $menu['image'] }}" alt="{{ $menu['name'] }}" height="100"></td>
                            <td>{{ $menu['name'] }}</td>
                            <td>{{ $menu['category'] }}</td>
                            <td class="text-center">
                                <div class="form-button-action justify-content-center">
                                    <a href="{{ route('menu.edit', $menu['id']) }}" class="btn btn-link btn-primary"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('menu.destroy', $menu['id']) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-link btn-danger" onclick="return confirm('Hapus menu ini?')"><i class="fa fa-times"></i></button>
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