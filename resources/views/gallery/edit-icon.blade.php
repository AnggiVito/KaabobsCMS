@extends('componens.mainLogin')
@section('content')
<div class="page-inner">
    <div class="card"><div class="card-header"><div class="card-title">{{ $subTitle }}</div></div>
        <form action="{{ route('gallery.icon.update', $item['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @if ($errors->any())<div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                <div class="form-group">
                    <label>Nama Media Sosial</label>
                    <input type="text" class="form-control" name="title" value="{{ $item['title'] }}" required>
                </div>
                <div class="form-group">
                    <label>URL Link</label>
                    <input type="url" class="form-control" name="link_url" value="{{ $item['linkUrl'] }}" required>
                </div>
                <div class="form-group">
                    <label for="image">File Ikon (SVG/PNG)</label>
                    <input type="file" class="form-control" name="image" accept="image/svg+xml,image/png">
                    <img src="{{ config('services.adonis.public_url') }}/{{ $item['imageUrl'] }}" height="30" class="mt-2" style="background-color: #333; padding: 5px; border-radius: 5px;">
                </div>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('gallery.index') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection