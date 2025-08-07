@extends('componens/mainLogin')

@section('content')
    <?php
    $namaArray = explode(' ', $pegawai->name, 2); // Pisahkan string menjadi dua bagian berdasarkan spasi pertama
    $namaDepan = $namaArray[0];
    $namaBelakang = isset($namaArray[1]) ? $namaArray[1] : '-'; // Pastikan nama belakang ada
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <div class="card card-warning card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('/assets/dist/img/avatar04.png') }}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $pegawai->name }}</h3>
                        <p class="text-muted text-center">{{ $pegawai->role . '-' . $pegawai->departemen }}</p>
                        <a href="{{ url('logout') }}" class="btn btn-warning btn-block"><b>Logout</b></a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Menu</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#informasiPribadiPekerjaan"
                                    role="tab" aria-controls="informasiPribadiPekerjaan">
                                    <i class="fas fa-info-circle"></i> Informasi Pribadi & Pekerjaan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="menu-izin-sakit" data-toggle="tab" href="#izinSakit" role="tab"
                                    aria-controls="izinSakit" aria-selected="false">
                                    <i class="fas fa-envelope"></i> Izin/Sakit
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pengaturan" role="tab"
                                    aria-controls="pengaturan" aria-selected="false">
                                    <i class="fas fa-cog"></i> Pengaturan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-md-9 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="informasiPribadiPekerjaan" role="tabpanel"
                                aria-labelledby="informasiPribadi-tab">
                                <div class="box-conten-profle p-3  mb-3">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <h5>
                                                <strong><i class="fas fa-user-tag"></i> Informasi Peribadi</strong>
                                            </h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="field-info">Nama Depan</div>
                                                    <div class="field-value">{{ $namaDepan }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="field-info">Nama Belakang</div>
                                                    <div class="field-value">{{ $namaBelakang }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-info">Jenis Kelamin</div>
                                                    <div class="field-value">
                                                        {{ $pegawai->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="field-info">Tempat Lahir</div>
                                                    <div class="field-value">{{ $pegawai->tempat_lahir }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="field-info">Tanggal Lahir</div>
                                                    <div class="field-value">{{ $pegawai->tanggal_lahir }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-info">Status Pernikahan</div>
                                                    <div class="field-value">{{ $pegawai->status_pernikahan }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-info">Nomor Identifikasi (KTP/SIM)</div>
                                                    <div class="field-value">{{ $pegawai->no_identitas }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-info">NPWP</div>
                                                    <div class="field-value">{{ $pegawai->no_npwp }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-info">Alamat Tempat Tinggal</div>
                                                    <div class="field-value">{{ $pegawai->alamat }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="field-info">Nomor Telepon/Handphone/WA</div>
                                                    <div class="field-value">{{ $pegawai->no_telpon }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="field-info">Kontak Darurat</div>
                                                    <div class="field-value">{{ $pegawai->no_kontak_darurat }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-info">Alamat Email</div>
                                                    <div class="field-value">{{ $pegawai->email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <h5>
                                                <strong><i class="fas fa-briefcase"></i> Informasi Pekerjaan</strong>
                                            </h5>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="field-info">Nomor Induk Pegawai (NIP)</div>
                                                    <div class="field-value">{{ $pegawai->nip }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="field-info">Tanggal Bergabung</div>
                                                    <div class="field-value">{{ $pegawai->tanggal_bergabung }}</div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="field-info">Tanggal Berakhir</div>
                                                    <div class="field-value">{{ $pegawai->tanggal_berakhir ?: '-' }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-info">Jabatan/Posisi</div>
                                                    <div class="field-value">{{ $pegawai->role }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-info">Departemen/Divisi</div>
                                                    <div class="field-value">{{ $pegawai->departemen }}</div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="field-info">Status Pekerjaan</div>
                                                    <div class="field-value">{{ $pegawai->status_pekerjaan }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="izinSakit" role="tabpanel" aria-labelledby="izinSakit-tab">
                                <div class="box-conten-profle p-3  mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-3">
                                                <strong><i class="fas fa-align-left"></i></i> Form Izin/Sakit</strong>
                                            </h5>
                                            <form id="izinSakitForm" action="javascript:void(0)">
                                                <div class="row justify-content-between">
                                                    <div class="col-md-2 col-sm-12">
                                                        <div class="form-group ">
                                                            <label class="col-12 control-label">Type</label>
                                                            <div class="col-12">
                                                                <select class="form-control" name="type"
                                                                    id="type" required>
                                                                    <!-- <option selected="selected">Alabama</option> -->
                                                                    <option value="SAKIT">Sakit</option>
                                                                    <option value="IZIN">Izin</option>
                                                                </select>
                                                                <small id="invalid-type"
                                                                    class="help-block text-danger"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="namaMember"
                                                                class="col-12 control-label">Tanggal</label>
                                                            <div class="col-12">
                                                                <input type="date" class="form-control" id="tanggal"
                                                                    name="tanggal" placeholder="Enter Tanggal"
                                                                    maxlength="50" required>
                                                                <small id="invalid-tanggal"
                                                                    class="help-block text-danger"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Keterangan</label>
                                                            <input type="text" class="form-control" name="keterangan"
                                                                id="keterangan" placeholder="Enter Keterangan">
                                                            <small id="invalid-keterangan"
                                                                class="help-block text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <div class="form-group">
                                                            <label>&nbsp; &nbsp;</label>
                                                            <button class="form-control btn btn-primary"
                                                                id="btn-add-izin-sakit"> Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <h5>
                                                <strong><i class="fas fa-table"></i> Daftar Izin/Sakit</strong>
                                            </h5>
                                            <table id="myTable" class="table table-bordered data-table" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Type</th>
                                                        <th>Keterangan</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pendidikanKeterampilan" role="tabpanel"
                                aria-labelledby="pendidikanKeterampilan-tab">
                                <div class="box-conten-profle p-3  mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>
                                                <strong><i class="fas fa-user-graduate"></i> Informasi Pendidikan</strong>
                                            </h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Jenjang Pendidikan</th>
                                                        <th>Institusi</th>
                                                        <th>Jurusan</th>
                                                        <th>Tahun Masuk</th>
                                                        <th>Tahun Lulus</th>
                                                        <th>Gelar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Sarjana 1</td>
                                                        <td>Telkom University</td>
                                                        <td>Informatika</td>
                                                        <td>2016</td>
                                                        <td>2020</td>
                                                        <td>S.kom</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pengaturan" role="tabpanel" aria-labelledby="pengaturan-tab">
                                <div class="box-conten-profle p-3  mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="mb-3">
                                                <strong><i class="fas fa-user-cog"></i> Pengaturan Username</strong>
                                            </h5>
                                            <form id="usernameForm" action="javascript:void(0)">
                                                <div class="row">
                                                    <div class="col-md-5 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input type="text" class="form-control" name="username"
                                                                id="username" placeholder="Username">
                                                            <small id="invalid-username"
                                                                class="help-block text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Konfirmasi Password</label>
                                                            <input type="password" class="form-control" name="password"
                                                                id="password" placeholder="Konfirm Password">
                                                            <small id="invalid-password"
                                                                class="help-block text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <div class="form-group">
                                                            <label>&nbsp; &nbsp;</label>
                                                            <button class="form-control btn btn-primary"
                                                                id="btn-update-usename"> Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-12">
                                            <h5 class="mb-3 mt-4">
                                                <strong><i class="fas fa-user-lock"></i> Pengaturan Password</strong>
                                            </h5>
                                            <form id="passwordForm" action="javascript:void(0)">
                                                <div class="row justify-content-between">
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Pasword Lama</label>
                                                            <input type="password" class="form-control"
                                                                name="password_old" id="password_old"
                                                                placeholder="Password Lama">
                                                            <small id="invalid-password_old"
                                                                class="help-block text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Pasword Baru</label>
                                                            <input type="password" class="form-control"
                                                                name="password_new" id="password_new"
                                                                placeholder="Password Baru">
                                                            <small id="invalid-password_new"
                                                                class="help-block text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Konfirmasi Password</label>
                                                            <input type="password" class="form-control"
                                                                name="password_konfirm" id="password_konfirm"
                                                                placeholder="Konfirm Password">
                                                            <small id="invalid-password_konfirm"
                                                                class="help-block text-danger"></small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12">
                                                        <div class="form-group">
                                                            <label>&nbsp; &nbsp;</label>
                                                            <button class="form-control btn btn-primary"
                                                                id="btn-update-password"> Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="modal fade" id="izin-sakit-modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Hapus Member</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin hapus data ini ? <b id="text-delete"></b></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-delete">Hapus</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '#menu-izin-sakit', function() {
                $(".data-table").dataTable().fnDestroy();
                $('.data-table').DataTable({
                    "scrollCollapse": true,
                    "autoWidth": false,
                    "responsive": true,
                    processing: true,
                    serverSide: true,
                    "columnDefs": [{
                        "defaultContent": "-",
                        "targets": "_all"
                    }, {
                        width: 105,
                        targets: 3
                    }],
                    order: [
                        [1, 'asc']
                    ],
                    ajax: "{{ url('apiweb/profile/izinSakit/list') }}",
                    columns: [{
                            data: 'tanggal',
                            width: '15%',
                            render: function(data, type, row) {
                                return moment(data).format('YYYY-MM-DD');
                            }
                        },
                        {
                            data: 'type',
                            name: 'type',
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan',
                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '60'
                        },
                    ]
                });
                //table_point.ajax.reload();
            });

            $('#btn-update-usename').click(function() {
                var formData = $('#usernameForm').serialize();
                $.ajax({
                    type: "PUT",
                    url: "{{ url('apiweb/profile/updateUsername') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(data) {
                        Toast.fire({
                            icon: 'success',
                            title: data.response
                        });
                        $('#usernameForm').trigger("reset");

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        let res = JSON.parse(XMLHttpRequest.responseText);
                        if (res.code === "01") {
                            var fields = [
                                'username',
                                'password',
                            ];

                            fields.forEach(function(field) {
                                if (res.response[field]) {
                                    $('#invalid-' + field).html(res.response[field][0]);
                                    $('#' + field).addClass('is-invalid');
                                } else {
                                    $('#invalid-' + field).empty();
                                    $('#' + field).removeClass('is-invalid');
                                }
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: errorThrown
                            })
                        }
                    }
                }); //end ajax
            })

            $('#btn-update-password').click(function() {
                var formData = $('#passwordForm').serialize();

                let password_new = $('#password_new').val();
                let password_konfirm = $('#password_konfirm').val();

                if (password_new != password_konfirm) {
                    $('#invalid-password_konfirm').html("Konfirmasi password tidak sama");
                    $('#password_konfirm').addClass('is-invalid');
                    return;
                }
                $('#invalid-password_konfirm').empty();
                $('#password_konfirm').removeClass('is-invalid');


                $.ajax({
                    type: "PUT",
                    url: "{{ url('apiweb/profile/updatePassword') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(data) {
                        Toast.fire({
                            icon: 'success',
                            title: data.response
                        });
                        $('#passwordForm').trigger("reset");

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        let res = JSON.parse(XMLHttpRequest.responseText);
                        if (res.code === "01") {
                            var fields = [
                                'password_old',
                                'password_new',
                            ];

                            fields.forEach(function(field) {
                                if (res.response[field]) {
                                    $('#invalid-' + field).html(res.response[field][0]);
                                    $('#' + field).addClass('is-invalid');
                                } else {
                                    $('#invalid-' + field).empty();
                                    $('#' + field).removeClass('is-invalid');
                                }
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: errorThrown
                            })
                        }
                    }
                }); //end ajax
            })

            $('#btn-add-izin-sakit').click(function() {
                var formData = $('#izinSakitForm').serialize();
                $.ajax({
                    type: "POST",
                    url: "{{ url('apiweb/profile/addIzinSakit') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(data) {
                        Toast.fire({
                            icon: 'success',
                            title: data.response
                        });
                        $('#izinSakitForm').trigger("reset");
                        $('#menu-izin-sakit').trigger('click');

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        let res = JSON.parse(XMLHttpRequest.responseText);
                        if (res.code === "01") {
                            var fields = [
                                'type',
                                'tanggal',
                                'keterangan'
                            ];

                            fields.forEach(function(field) {
                                if (res.response[field]) {
                                    $('#invalid-' + field).html(res.response[field][0]);
                                    $('#' + field).addClass('is-invalid');
                                } else {
                                    $('#invalid-' + field).empty();
                                    $('#' + field).removeClass('is-invalid');
                                }
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: errorThrown
                            })
                        }
                    }
                }); //end ajax
            });
            $(document).on('click', '.btn-delete', function() {
                $('#izin-sakit-modal-delete').modal('show');
                var deleteId = $(this).data('id');
                console.log(deleteId);
                $('#btn-delete').val(deleteId);
            });
            $('#btn-delete').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('apiweb/profile/deleteIzinSakit') }}" + "/" + $(this).attr(
                        "value"),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#izin-sakit-modal-delete').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: data.response
                        })
                        $('#menu-izin-sakit').trigger('click');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        let res = JSON.parse(XMLHttpRequest.responseText);
                        $('#izin-sakit-modal-delete').modal('hide');
                        Toast.fire({
                            icon: 'error',
                            title: errorThrown
                        });
                    }
                }); //end ajax
            })
        });
    </script>
@endsection
