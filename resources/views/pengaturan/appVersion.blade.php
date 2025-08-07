@extends('componens/mainLogin')
<style>
    .h1 {
        letter-spacing: -0.02em;
    }

    .dropzone {
        overflow-y: auto;
        border: 0;
        background: transparent;
    }

    .dz-preview {
        width: 100%;
        margin: 0 !important;
        height: 100%;
        padding: 15px;
        position: absolute !important;
        top: 0;
    }

    .dz-photo {
        height: 100%;
        width: 100%;
        overflow: hidden;
        border-radius: 12px;
        background: #eae7e2;
    }

    .dz-drag-hover .dropzone-drag-area {
        border-style: solid;
        border-color: #86b7fe;
        ;
    }

    .dz-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dz-image {
        width: 90px !important;
        height: 90px !important;
        border-radius: 6px !important;
    }

    .dz-remove {
        display: none !important;
    }

    .dz-delete {
        width: 24px;
        height: 24px;
        background: rgba(0, 0, 0, 0.57);
        position: absolute;
        opacity: 0;
        transition: all 0.2s ease;
        top: 30px;
        right: 30px;
        border-radius: 100px;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dz-delete>svg {
        transform: scale(0.75);
        cursor: pointer;
    }

    .dz-preview:hover .dz-delete,
    .dz-preview:hover .dz-remove-image {
        opacity: 1;
    }

    .dz-message {
        height: 100%;
        margin: 0 !important;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dropzone-drag-area {
        height: 300px;
        position: relative;
        padding: 0 !important;
        border-radius: 10px;
        border: 3px dashed #dbdeea;
    }

    .was-validated .form-control:valid {
        border-color: #dee2e6 !important;
        background-image: none;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-table"></i> Data App Version</h3>
                        @if(actionRole($subTitle,'c'))
                        <button type="button" class="btn btn-primary btn-sm float-right" id="add"
                            href="javascript:void(0)"><i class="fa fa-plus"></i> Add Version </button>
                        @endif
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered data-table" width="100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>tanggal</th>
                                    <th>Nama Aplikasi</th>
                                    <th>Version</th>
                                    <th>Platform</th>
                                    <th>link</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="appVersion-model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="AppVersionModel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form id="formDropzone" name="AppVersionForm" class="form-horizontal dropzone overflow-visible p-0"
                    method="POST" enctype="multipart/form-data"> --}}
                <div class="modal-body">
                    {{-- <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label class="col-12 control-label">Nama Aplikasi</label>
                            <div class="col-12">
                                <select class="form-control select2" name="app_name" id="select-filter-appName" required>
                                    <!-- <option selected="selected">Alabama</option> -->
                                    <option value="ARJ-POS">ARJ Kasir</option>
                                    <option value="ARJ-MANAGER">ARJ Manager</option>
                                    <option value="ARJ-CHECKER">ARJ Checker</option>
                                </select>
                                <small id="invalid-appName" class="help-block text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="applicationVersion" class="col-12 control-label">Application Version</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="applicationVersion" name="version"
                                    placeholder="Enter nama supplier" maxlength="50" required>
                                <small id="invalid-applicationVersion" class="help-block text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-12 control-label">Platform Aplikasi</label>
                            <div class="col-12">
                                <select class="form-control select2" name="platform_app" id="select-filter-platformApp"
                                    required>
                                    <!-- <option selected="selected">Alabama</option> -->
                                    <option value="DESKTOP">Desktop</option>
                                    <option value="ANDROID">Android</option>
                                    <option value="WEB">Web</option>
                                </select>
                                <small id="invalid-platformApp" class="help-block text-danger"></small>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label text-muted opacity-75 fw-medium" for="formImage">Image</label>
                            <div class="dropzone-drag-area form-control" id="previews">
                                <div class="dz-message text-muted opacity-50" data-dz-message>
                                    <span>Drag file here to upload</span>
                                </div>
                                <div class="d-none" id="dzPreviewContainer">
                                    <div class="dz-preview dz-file-preview">
                                        <div class="dz-photo">
                                            <img class="dz-thumbnail" data-dz-thumbnail>
                                        </div>
                                        <button class="dz-delete border-0 p-0" type="button" data-dz-remove>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times">
                                                <path fill="#FFFFFF"
                                                    d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback fw-bold">Please upload an image.</div>
                        </div> --}}
                    <div id="actions" class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="applicationVersion" class="col-12 control-label">Version</label>
                                <input type="text" class="form-control" id="applicationVersion" name="version"
                                    placeholder="1.0.0" maxlength="50" required>
                                <small id="invalid-applicationVersion" class="help-block text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Type</label>
                                <select class="form-control" name="app_name" id="appName" required>
                                    <option value="ARJ-POS">ARJ Kasir</option>
                                    <option value="ARJ-MANAGER">ARJ Manager</option>
                                    <option value="ARJ-CHECKER">ARJ Checker</option>
                                </select>
                                <small id="invalid-appName" class="help-block text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Platform</label>
                                <select class="form-control" name="platform_app" id="platformApp" required>
                                    <!-- <option selected="selected">Alabama</option> -->
                                    <option value="DESKTOP" selected>Desktop</option>
                                    <option value="ANDROID">Android</option>
                                    <option value="WEB">Web</option>
                                </select>
                                <small id="invalid-platformApp" class="help-block text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label d-flex align-items-center mb-3">
                                    <div class="fileupload-process w-100">
                                        <div id="total-progress" class="progress progress-striped active" role="progressbar"
                                            aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"
                                                data-dz-uploadprogress>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <div class="btn-group w-100">
                                    <span class="btn btn-success col fileinput-button">
                                        <i class="fas fa-plus"></i>
                                        <span>Add files</span>
                                    </span>
                                    <button type="submit" class="btn btn-primary col start">
                                        <i class="fas fa-upload"></i>
                                        <span>Start</span>
                                    </button>
                                    <button type="reset" class="btn btn-warning col cancel">
                                        <i class="fas fa-times-circle"></i>
                                        <span>Cancel</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="btn-group w-100">


                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">

                        </div>
                    </div>
                    <div class="table table-striped files" id="previews">
                        <div id="template" class="row mt-2">
                            <div class="col-auto">
                                <span class="preview"><img src="data:," alt data-dz-thumbnail /></span>
                            </div>
                            <div class="col d-flex align-items-center">
                                <p class="mb-0">
                                    <span class="lead" data-dz-name></span>
                                    (<span data-dz-size></span>)
                                </p>
                                <strong class="error text-danger" data-dz-errormessage></strong>
                            </div>
                            <div class="col-4 d-flex align-items-center">
                                <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0"
                                    aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"
                                        data-dz-uploadprogress>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                {{-- <div class="btn-group"> --}}
                                    <button class="btn btn-primary start" style="display: none">
                                        <i class="fas fa-upload"></i>
                                        <span></span>
                                    </button>
                                    <button data-dz-remove class="btn btn-warning cancel" style="display: none">
                                        <i class="fas fa-times-circle"></i>
                                        <span></span>
                                    </button>
                                    <button data-dz-remove class="btn btn-danger delete">
                                        <i class="fas fa-trash"></i>
                                        <span></span>
                                    </button>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </form> --}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="appVersion-model-delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Confirm Hapus Supplier</h4>
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
            var table = $('.data-table').DataTable({
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
                    targets: 5
                }],
                ajax: "{{ url('apiweb/appVersion') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'app_name',
                        name: 'app_name'
                    },
                    {
                        data: 'version',
                        name: 'version'
                    },
                    {
                        data: 'platform_app',
                        name: 'platform_app'
                    },
                    {
                        data: 'file_name',
                        name: 'file_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '130'
                    },
                ]
            });

            $('#add').click(function() {
                $('#AppVersionForm').trigger("reset");
                $('#AppVersionModel').html("Add Supplier");
                $('#appVersion-model').modal('show');
                $('#invalid-appName').empty();
                $('#select-filter-appName').removeClass('is-invalid');
                $('#invalid-applicationVersion').empty();
                $('#applicationVersion').removeClass('is-invalid');
                $('#invalid-platformApp').empty();
                $('#select-filter-platformApp').removeClass('is-invalid');
                $('#btn-save').show();
                $('#btn-update').hide();
                $('#id').val('');
                $('#select-filter-appName').val(null).trigger('change');
                $('#select-filter-platformApp').val(null).trigger('change');
            });



            $(document).on('click', '.btn-edit', function() {
                $('#AppVersionForm').trigger("reset");
                $('#AppVersionModel').html("Edit User");
                $('#appVersion-model').modal('show');
                $('#invalid-appName').empty();
                $('#select-filter-appName').removeClass('is-invalid');
                $('#invalid-applicationVersion').empty();
                $('#applicationVersion').removeClass('is-invalid');
                $('#invalid-platformApp').empty();
                $('#select-filter-platformApp').removeClass('is-invalid');
                $('#btn-save').hide();
                $('#btn-update').show();
                let dataEdit = table.row($(this).parents('tr')).data()?table.row($(this).parents('tr')).data():table.row($(this)).data();
                $('#id').val(dataEdit.id);
                //console.log(dataEdit.app_name);
                $('#select-filter-appName').val(dataEdit.app_name).trigger('change');
                $('#applicationVersion').val(dataEdit.version)
                $('#select-filter-platformApp').val(dataEdit.platform_app).trigger('change');
            });

            $(document).on('click', '.btn-delete', function() {
                $('#appVersion-model-delete').modal('show');
                let dataDelete = table.row($(this).parents('tr')).data()?table.row($(this).parents('tr')).data():table.row($(this)).data();;
                //$('#text-delete').html(dataDelete.telpon);
                $('#btn-delete').val(dataDelete.id);
            });

            $('#btn-update').click(function() {
                var updateId = $('#AppVersionForm').find('input[name="id"]').val();
                var formData = $('#AppVersionForm').serialize();
                $.ajax({
                    type: "PUT",
                    url: "{{ url('apiweb/appVersion') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(data) {
                        table.draw();
                        $('#appVersion-model').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: data.response
                        })

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        let res = JSON.parse(XMLHttpRequest.responseText);
                        if (res.code === "01") {
                            if (res.response.app_name) {
                                $('#invalid-appName').html(res.response.app_name[0]);
                                $('#select-filter-appName').addClass('is-invalid');
                            } else {
                                $('#invalid-appName').empty();
                                $('#select-filter-appName').removeClass('is-invalid');
                            }
                            if (res.response.version) {
                                $('#invalid-applicationVersion').html(res.response.version[0]);
                                $('#applicationVersion').addClass('is-invalid');
                            } else {
                                $('#invalid-applicationVersion').empty();
                                $('#applicationVersion').removeClass('is-invalid');
                            }
                            if (res.response.platform_app) {
                                $('#invalid-platformApp').html(res.response.platform_app[0]);
                                $('#select-filter-platformApp').addClass('is-invalid');
                            } else {
                                $('#invalid-platformApp').empty();
                                $('#select-filter-platformApp').removeClass('is-invalid');
                            }
                        } else {
                            $('#appVersion-model').modal('hide');
                            Toast.fire({
                                icon: 'error',
                                title: errorThrown
                            })
                        }
                    }
                }); //end ajax
            })

            // $('#btn-save').click(function() {
            //     var formData = $('#AppVersionForm').serialize();

            //     $.ajax({
            //         type: "POST",
            //         url: "{{ url('apiweb/supplier') }}",
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         data: formData,
            //         success: function(data) {
            //             table.draw();
            //             $('#appVersion-model').modal('hide');
            //             Toast.fire({
            //                 icon: 'success',
            //                 title: data.response
            //             })

            //         },
            //         error: function(XMLHttpRequest, textStatus, errorThrown) {
            //             let res = JSON.parse(XMLHttpRequest.responseText);
            //             if (res.code === "01") {
            //                 if (res.response.app_name) {
            //                     $('#invalid-appName').html(res.response.app_name[0]);
            //                     $('#select-filter-appName').addClass('is-invalid');
            //                 } else {
            //                     $('#invalid-appName').empty();
            //                     $('#select-filter-appName').removeClass('is-invalid');
            //                 }
            //                 if (res.response.version) {
            //                     $('#invalid-applicationVersion').html(res.response.version[0]);
            //                     $('#applicationVersion').addClass('is-invalid');
            //                 } else {
            //                     $('#invalid-applicationVersion').empty();
            //                     $('#applicationVersion').removeClass('is-invalid');
            //                 }
            //                 if (res.response.platform_app) {
            //                     $('#invalid-platformApp').html(res.response.platform_app[0]);
            //                     $('#select-filter-platformApp').addClass('is-invalid');
            //                 } else {
            //                     $('#invalid-platformApp').empty();
            //                     $('#select-filter-platformApp').removeClass('is-invalid');
            //                 }
            //             } else {
            //                 $('#appVersion-model').modal('hide');
            //                 Toast.fire({
            //                     icon: 'error',
            //                     title: errorThrown
            //                 })
            //             }
            //         }
            //     }); //end ajax
            // })

            $('#btn-delete').click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('apiweb/appVersion') }}" + "/" + $(this).attr("value"),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        table.draw();
                        $('#appVersion-model-delete').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: data.response
                        })

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        let res = JSON.parse(XMLHttpRequest.responseText);
                        $('#appVersion-model-delete').modal('hide');
                        Toast.fire({
                            icon: 'error',
                            title: errorThrown
                        });
                    }
                }); //end ajax
            })


            // $('#select-filter-appName').select2({
            //     placeholder: "Pilih Aplikasi",
            // });
            // $('#select-filter-appName').change(function() {
            //     let role = $(this).val();
            //     $('#select-filter-appName').val(null).trigger('change');
            // });
            // $('#select-filter-platform').select2({
            //     placeholder: "Pilih Platform Aplikasi",
            // });
            // $('#select-filter-platform').change(function() {
            //     let role = $(this).val();
            //     $('#select-filter-platform').val(null).trigger('change');
            // });
        });
    </script>
    <script>
        // Dropzone.autoDiscover = false;

        // /**
        //  * Setup dropzone
        //  */
        // $('#formDropzone').dropzone({
        //     previewTemplate: $('#dzPreviewContainer').html(),
        //     url: "{{ url('apiweb/appVersion') }}",
        //     method: "post",
        //     headers: {
        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //     },
        //     addRemoveLinks: true,
        //     autoProcessQueue: false,
        //     uploadMultiple: false,
        //     parallelUploads: 2,
        //     maxFiles: 2,
        //     // acceptedFiles: '.jpeg, .jpg, .png, .gif',
        //     thumbnailWidth: 900,
        //     thumbnailHeight: 600,
        //     previewsContainer: "#previews",
        //     timeout: 0,
        //     init: function() {
        //         myDropzone = this;

        //         // when file is dragged in
        //         this.on('addedfile', function(file) {
        //             $('.dropzone-drag-area').removeClass('is-invalid').next('.invalid-feedback').hide();
        //         });
        //     },
        //     success: function(file, response) {
        //         // hide form and show success message
        //         $('#formDropzone').fadeOut(600);
        //         setTimeout(function() {
        //             $('#successMessage').removeClass('d-none');
        //         }, 600);
        //     }
        // });

        // /**
        //  * Form on submit
        //  */
        // $('#btn-save').on('click', function(event) {
        //     event.preventDefault();
        //     var $this = $(this);

        //     // show submit button spinner
        //     $this.children('.spinner-border').removeClass('d-none');

        //     // validate form & submit if valid
        //     if ($('#formDropzone')[0].checkValidity() === false) {
        //         event.stopPropagation();

        //         // show error messages & hide button spinner    
        //         $('#formDropzone').addClass('was-validated');
        //         $this.children('.spinner-border').addClass('d-none');

        //         // if dropzone is empty show error message
        //         if (!myDropzone.getQueuedFiles().length > 0) {
        //             $('.dropzone-drag-area').addClass('is-invalid').next('.invalid-feedback').show();
        //         }
        //     } else {

        //         // if everything is ok, submit the form
        //         myDropzone.processQueue();
        //     }
        // });

        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "{{ url('apiweb/appVersion') }}",
            method: "post",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            let version = $('#applicationVersion').val();
            if (version == null || version == '') {
                $('#invalid-applicationVersion').html('');
                $('#applicationVersion').addClass('is-invalid');
            } else {
                $('#invalid-applicationVersion').empty();
                $('#applicationVersion').removeClass('is-invalid');
                myDropzone.options.params = {'version':$('#applicationVersion').val(),'app_name':$('#appName').val(),'platform_app':$('#platformApp').val()};
                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))   
            }
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }
        // DropzoneJS Demo Code End
    </script>
@endsection
