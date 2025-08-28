@extends('componens.mainLogin')

@section('content')
<div class="page-inner">
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('order-page.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Pengaturan Halaman Order</h4>
                    <button type="submit" class="btn btn-success btn-round ms-auto"><i class="fa fa-check"></i> Simpan Semua</button>
                </div>
            </div>
            <div class="card-body">
                <h5>Pengaturan Header</h5>
                <div class="form-group"><label>Judul Utama</label><input type="text" class="form-control" name="header_title" value="{{ old('header_title', $settings['headerTitle'] ?? '') }}"></div>
                <div class="form-group"><label>Deskripsi Paragraf 1</label><textarea class="form-control" name="header_desc1" rows="3">{{ old('header_desc1', $settings['headerDesc1'] ?? '') }}</textarea></div>
                <div class="form-group"><label>Deskripsi Paragraf 2</label><textarea class="form-control" name="header_desc2" rows="3">{{ old('header_desc2', $settings['headerDesc2'] ?? '') }}</textarea></div>
                <div class="form-group">
                    <label>Gambar Header</label>
                    <input type="file" class="form-control" name="header_image">
                    @if(isset($settings['headerImage']))<img src="{{ config('services.adonis.public_url') }}/{{ $settings['headerImage'] }}" class="img-thumbnail mt-2" style="max-height: 150px;">@endif
                </div>
                <hr>
                <div class="form-group"><label>Judul Seksi Pilihan Order</label><input type="text" class="form-control" name="section_title" value="{{ old('section_title', $settings['sectionTitle'] ?? '') }}"></div>
                <hr>

                <h5>Daftar Pilihan Order (4 Item Tetap)</h5>
                @php 
                    $orderOptions = $settings['orderOptions'] ?? []; 
                @endphp
                @for ($i = 0; $i < 4; $i++)
                <div class="p-3 mb-2" style="border: 1px solid #eee; border-radius: 5px;">
                    <h6>Pilihan #{{ $i + 1 }}</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="order_options[{{$i}}][name]" 
                                    value="{{ old('order_options.'.$i.'.name', $orderOptions[$i]['name'] ?? '') }}"
                                    placeholder="Contoh: GrabFood">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>URL</label>
                                <input type="url" class="form-control" name="order_options[{{$i}}][url]" 
                                    value="{{ old('order_options.'.$i.'.url', $orderOptions[$i]['url'] ?? '') }}"
                                    placeholder="https://food.grab.com/...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Gambar/Logo</label>
                        <input type="file" class="form-control" name="order_options[{{$i}}][image]">
                        @if(isset($orderOptions[$i]['image']))
                            <div class="mt-2">
                                <img src="{{ config('services.adonis.public_url') }}/{{ $orderOptions[$i]['image'] }}" class="img-thumbnail mt-2" height="40">
                            </div>
                        @endif
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </form>
</div>
@endsection