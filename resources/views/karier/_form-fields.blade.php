@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="row">
    <div class="col-md-4 form-group">
        <label for="namaposisi">Nama Posisi</label>
        <input type="text" class="form-control" id="namaposisi" name="namaposisi" placeholder="Contoh: Staff IT" 
            value="{{ old('namaposisi', $karier['namaposisi'] ?? '') }}" required>
    </div>
    <div class="col-md-4 form-group">
        <label for="posting">Tanggal Posting</label>
        <input type="date" class="form-control" id="posting" name="posting" 
            value="{{ old('posting', isset($karier) ? \Carbon\Carbon::parse($karier['posting'])->format('Y-m-d') : '') }}" required>
    </div>
</div>

<div class="row">
    <div class="col-md-4 form-group">
        <label for="kota">Kota</label>
        <input type="text" class="form-control" id="kota" name="kota" placeholder="Contoh: Bandung" 
            value="{{ old('kota', $karier['kota'] ?? '') }}" required>
    </div>
    <div class="col-md-4 form-group">
        <label for="provinsi">Provinsi</label>
        <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Contoh: Jawa Barat" 
            value="{{ old('provinsi', $karier['provinsi'] ?? '') }}" required>
    </div>
</div>

<div class="row">
    <div class="col-md-4 form-group">
        <label for="workplace">Tempat Kerja</label>
        <input type="text" class="form-control" id="workplace" name="workplace" placeholder="On-Site / Remote / Hybrid" 
            value="{{ old('workplace', $karier['workplace'] ?? '') }}" required>
    </div>
    <div class="col-md-4 form-group">
        <label for="worktype">Tipe Pekerjaan</label>
        <input type="text" class="form-control" id="worktype" name="worktype" placeholder="Full-Time / Part-Time" 
            value="{{ old('worktype', $karier['worktype'] ?? '') }}" required>
    </div>
    <div class="col-md-4 form-group">
        <label for="paytype">Tipe Gaji</label>
        <input type="text" class="form-control" id="paytype" name="paytype" placeholder="Per Bulan / Per Proyek" 
            value="{{ old('paytype', $karier['paytype'] ?? '') }}" required>
    </div>
</div>

<div class="row">
    <div class="col-md-2 form-group">
        <label for="payrangeFrom">Rentang gaji dari</label>
        <input type="text" class="form-control" id="payrangeFrom" name="payrangeFrom" placeholder="Rp" 
            value="{{ old('payrangeFrom', $karier['payrangeFrom'] ?? '') }}" required>
    </div>
    <div class="col-md-2 form-group">
        <label for="payrangeTo">Rentang gaji ke</label>
        <input type="text" class="form-control" id="payrangeTo" name="payrangeTo" placeholder="Rp" 
            value="{{ old('payrangeTo', $karier['payrangeTo'] ?? '') }}" required>
    </div>
</div>

<div class="form-group">
    <label for="jobSummary">Ringkasan Pekerjaan</label>
    <textarea class="form-control" id="jobSummary" name="jobSummary" rows="3" required>{{ old('jobSummary', $karier['jobSummary'] ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="deskripsi">Deskripsi Lengkap</label>
    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $karier['deskripsi'] ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="jobRequirement">Syarat Pekerjaan</label>
    <textarea class="form-control" id="jobRequirement" name="jobRequirement" rows="5" required>{{ old('jobRequirement', $karier['jobRequirement'] ?? '') }}</textarea>
</div>