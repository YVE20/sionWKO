@extends('layouts.app',['title' => 'Sion WKO| Data Jemaat - Kartu Keluarga'])
@section('content')
@include('DataJemaat.KartuKeluarga.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row"> 
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahKartuKeluargaModal()"> <i class="fas fa-plus-circle"></i> Tambah Kartu Keluarga</a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> No KK </th>
                            <th> Kepala Keluarga </th>
                            <th> Alamat </th>
                            <th> RT/RW </th>
                            <th> Kode Pos </th>
                            <th> KK </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataKartuKeluarga">

                    </tbody>
                </table>
            </div>
            <div class="row"> 
                <div id="nav-output" class="col-lg-12"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    var current_page_index = 1;
    var last_index = '{{$kartuKeluarga->lastPage()}}';
    var current_pagination_index = 1;
    @if(session()->has('status'))
        Swal.fire({
            icon: '{{session()->has("icon") ? session("icon") : "success"}}',
            title: '{{session("judul_alert")}}',
            text : '{{session("status")}}',
            showConfirmButton: false,
            timer: 1500
        })
    @endif 
    function pagination_prev(){
        if(current_page_index != 1){
            current_page_index -= 1;
            getDataKartuKeluarga();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index-1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == 1){
                $(this).addClass('disabled');
            }
        }
    }
    function pagination_item(page){
        current_page_index = page;
        getDataKartuKeluarga();
        if(current_page_index != 1){
            $('#prev-page').removeClass('disabled');
        }else{
          $('#prev-page').addClass('disabled');
        }
        if(current_page_index != last_index){
            $('#next-page').removeClass('disabled');
        }else{
            $('#next-page').addClass('disabled');
        }
        $('.page-item-number').removeClass('active');
        $(this).addClass('active');
    }
    function pagination_next(){
        if(current_page_index != last_index){
            current_page_index += 1;
            getDataKartuKeluarga();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    $(document).ready(function(){
        getDataKartuKeluarga();
    });
    function getTempDetailKartuKeluarga(){
        $.ajax({
            url : '<?= url('/adm/dataJemaat/getTempDetailKartuKeluarga') ?>',
            method :  'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $('#output-detail').html(data);
            }
        });
    }
    function getDetailKartuKeluarga(familyCard_id){
        $.ajax({
            url : '<?= url('/adm/dataJemaat/getDetailKartuKeluarga') ?>',
            method :  'POST',
            data : {familyCard_id : familyCard_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $('#output-detail').html(data);
            }
        });
    }
    function getDataKartuKeluarga(){
        $.ajax({
            url : '<?= url('/adm/dataJemaat/getAllKartuKeluarga') ?>',
            method :  'POST',
            data : {page:current_page_index },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataKartuKeluarga').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function editKartuKeluargaModal(familyCard_id){
        document.getElementById('cmd').value = "edit";
        $('#viewKartuKeluargaModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Kartu Keluarga');
        $('#tampilKartuKeluargaModal').attr('action','<?= '/adm/dataJemaat/updateKartuKeluarga' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showKartuKeluargaModel') ?>',
            data : {cmd : $('#cmd').val(), familyCard_id : familyCard_id },
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $('#isiModalKartuKeluarga').html(data);
                getDetailKartuKeluarga(familyCard_id);
            }
        });
    }
    function editDetailKartuKeluarga(NIK){
        document.getElementById('cmdDetailKK').value = "edit";
        const familyCard_id = $('#familyCard_id').val();
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showDetailKartuKeluargaModel/edit') ?>',
            method : 'POST',
            data : {NIK : NIK },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $('#data-output').html(data);
                getDetailKartuKeluarga(familyCard_id)
            }
        });
    }
    function editTempDetailKartuKeluarga(NIK){
        document.getElementById('cmdDetailKK').value = "edit";
        const familyCard_id = $('#familyCard_id').val();
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showTempDetailKartuKeluargaModel/edit') ?>',
            method : 'POST',
            data : {NIK : NIK },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $('#data-output').html(data);
                getTempDetailKartuKeluarga(familyCard_id)
            }
        });
    }
    function tambahKartuKeluargaModal(){
        document.getElementById('cmd').value = "add";
        $('#viewKartuKeluargaModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Kartu Keluarga');
        $('#tampilKartuKeluargaModal').attr('action','<?= '/adm/dataJemaat/createKartuKeluarga' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-save"></i> Simpan Data');
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showKartuKeluargaModel') ?>',
            data : {cmd : $('#cmd').val() },
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $('#isiModalKartuKeluarga').html(data);
                getTempDetailKartuKeluarga();
            }
        });
    }
    function updateTempDetailKartuKeluarga(){
        const familyCard_id = $('#familyCard_id').val();
        $.ajax({
            url : '<?= url('/adm/dataJemaat/updateTempDetailKartuKeluarga') ?>',
            data : {
                familyCard_id : $('#familyCard_id').val(),
                NIK :  $('#NIK').val(),
                fullName : $('#fullName').val(),
                gender : $('#gender').val(),
                place_ofBirth : $('#place_ofBirth').val(),
                date_ofBirth :  $('#date_ofBirth').val(),
                religion :  $('#religion').val(),
                education :  $('#education').val(),
                job :  $('#job').val(),
                blood :  $('#blood').val(),
                marriage :  $('#marriage').val(),
                date_ofMarriage :  $('#date_ofMarriage').val(),
                family_status :  $('#family_status').val(),
                citizenship :  $('#citizenship').val(),
                paspor :  $('#paspor').val(),
                fatherName :  $('#fatherName').val(),
                motherName :  $('#motherName').val(),
            },
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                if(data == "success"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil ditambahkan',
                        showConfirmButton: false,   
                        timer: 1500
                    });
                    getTempDetailKartuKeluarga(familyCard_id);
                    $('#NIK').val("");
                    $('#NIK').attr('readonly',false);
                    $('#NIK').attr('placeholder',"NIK");
                    $('#fullName').val("");
                    $('#fullName').attr('placeholder',"Nama Lengkap");
                    $('#gender').val("-");
                    $('#place_ofBirth').val("");
                    $('#place_ofBirth').attr('placeholder',"Tempat Lahir");
                    $('#date_ofBirth').val("");
                    $('#date_ofBirth').attr('placeholder',"Tanggal Lahir");
                    $('#religion').val("-");
                    $('#education').val("-");
                    $('#job').val("");
                    $('#job').attr('placeholder',"Pekerjaan");
                    $('#blood').val("-");
                    $('#marriage').val("-");
                    $('#date_ofMarriage').val("");
                    $('#date_ofBirth').attr('placeholder',"Tanggal Pernikahan");
                    $('#family_status').val("-");
                    $('#citizenship').val("WNI");
                    $('#paspor').val("");
                    $('#paspor').attr('placeholder',"No Paspor");
                    $('#fatherName').val("");
                    $('#fatherName').attr('placeholder',"Nama Ayah");
                    $('#motherName').val("");
                    $('#motherName').attr('placeholder',"Nama Ibu");
                    $('#addDetail').html("<i class='fas fa-plus-circle'> </i> Tambah Data");
                    $('#addDetail').attr('onclick','tambahDetailKartuKeluarga()');
                }
            }
        });
    }
    function updateDetailKartuKeluarga(){
        const familyCard_id = $('#familyCard_id').val();
        $.ajax({
            url : '<?= url('/adm/dataJemaat/updateDetailKartuKeluarga') ?>',
            data : {
                familyCard_id : $('#familyCard_id').val(),
                NIK :  $('#NIK').val(),
                fullName : $('#fullName').val(),
                gender : $('#gender').val(),
                place_ofBirth : $('#place_ofBirth').val(),
                date_ofBirth :  $('#date_ofBirth').val(),
                religion :  $('#religion').val(),
                education :  $('#education').val(),
                job :  $('#job').val(),
                blood :  $('#blood').val(),
                marriage :  $('#marriage').val(),
                date_ofMarriage :  $('#date_ofMarriage').val(),
                family_status :  $('#family_status').val(),
                citizenship :  $('#citizenship').val(),
                paspor :  $('#paspor').val(),
                fatherName :  $('#fatherName').val(),
                motherName :  $('#motherName').val(),
            },
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                if(data == "success"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil ditambahkan',
                        showConfirmButton: false,   
                        timer: 1500
                    });
                    getDetailKartuKeluarga(familyCard_id);
                    $('#NIK').val("");
                    $('#NIK').attr('readonly',false);
                    $('#NIK').attr('placeholder',"NIK");
                    $('#fullName').val("");
                    $('#fullName').attr('placeholder',"Nama Lengkap");
                    $('#gender').val("-");
                    $('#place_ofBirth').val("");
                    $('#place_ofBirth').attr('placeholder',"Tempat Lahir");
                    $('#date_ofBirth').val("");
                    $('#date_ofBirth').attr('placeholder',"Tanggal Lahir");
                    $('#religion').val("-");
                    $('#education').val("-");
                    $('#job').val("");
                    $('#job').attr('placeholder',"Pekerjaan");
                    $('#blood').val("-");
                    $('#marriage').val("-");
                    $('#date_ofMarriage').val("");
                    $('#date_ofBirth').attr('placeholder',"Tanggal Pernikahan");
                    $('#family_status').val("-");
                    $('#citizenship').val("WNI");
                    $('#paspor').val("");
                    $('#paspor').attr('placeholder',"No Paspor");
                    $('#fatherName').val("");
                    $('#fatherName').attr('placeholder',"Nama Ayah");
                    $('#motherName').val("");
                    $('#motherName').attr('placeholder',"Nama Ibu");
                    $('#addDetail').html("<i class='fas fa-plus-circle'> </i> Tambah Data");
                    $('#addDetail').attr('onclick','tambahDetailKartuKeluarga()');
                }
            }
        });
    }
    function tambahDetailKartuKeluarga(){
        document.getElementById('addDetail').value = "add";
        if($('#NIK').val() == ""){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'NIK tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#fullName').val() == ""){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Nama tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#gender').val() == "-"){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Jenis Kelamin tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#place_ofBirth').val() == ""){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Tempat lahir tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#date_ofBirth').val() == ""){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Tanggal lahir tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#religion').val() == "-"){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Agama tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#education').val() == "-"){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Pendidikan tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#job').val() == ""){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Pekerjaan tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#blood').val() == "-"){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Golongan darah tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#marriage').val() == "-"){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Status Perkawinan tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#family_status').val() == "-"){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Hubungan keluarga tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#fatherName').val() == ""){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Nama Ayah tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else if($('#motherName').val() == ""){
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Nama Ibu tidak boleh kosong',
                showConfirmButton: false,   
                timer: 1500
            });
        }else{
            $.ajax({
                url : '<?= url('/adm/dataJemaat/createTempDetailKartuKeluarga') ?>',
                data : {
                    cmd : $('#addDetail').val(),
                    familyCard_id : $('#familyCard_id').val(),
                    NIK :  $('#NIK').val(),
                    fullName : $('#fullName').val(),
                    gender : $('#gender').val(),
                    place_ofBirth : $('#place_ofBirth').val(),
                    date_ofBirth :  $('#date_ofBirth').val(),
                    religion :  $('#religion').val(),
                    education :  $('#education').val(),
                    job :  $('#job').val(),
                    blood :  $('#blood').val(),
                    marriage :  $('#marriage').val(),
                    date_ofMarriage :  $('#date_ofMarriage').val(),
                    family_status :  $('#family_status').val(),
                    citizenship :  $('#citizenship').val(),
                    paspor :  $('#paspor').val(),
                    fatherName :  $('#fatherName').val(),
                    motherName :  $('#motherName').val(),
                },
                method : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    if(data == "success"){
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data berhasil ditambahkan',
                            showConfirmButton: false,   
                            timer: 1500
                        });
                        getTempDetailKartuKeluarga();
                        $('#NIK').val("");
                        $('#NIK').attr('placeholder',"NIK");
                        $('#fullName').val("");
                        $('#fullName').attr('placeholder',"Nama Lengkap");
                        $('#gender').val("-");
                        $('#place_ofBirth').val("");
                        $('#place_ofBirth').attr('placeholder',"Tempat Lahir");
                        $('#date_ofBirth').val("");
                        $('#date_ofBirth').attr('placeholder',"Tanggal Lahir");
                        $('#religion').val("-");
                        $('#education').val("-");
                        $('#job').val("");
                        $('#job').attr('placeholder',"Pekerjaan");
                        $('#blood').val("-");
                        $('#marriage').val("-");
                        $('#date_ofMarriage').val("");
                        $('#date_ofBirth').attr('placeholder',"Tanggal Pernikahan");
                        $('#family_status').val("-");
                        $('#citizenship').val("WNI");
                        $('#paspor').val("");
                        $('#paspor').attr('placeholder',"No Paspor");
                        $('#fatherName').val("");
                        $('#fatherName').attr('placeholder',"Nama Ayah");
                        $('#motherName').val("");
                        $('#motherName').attr('placeholder',"Nama Ibu");
                    }
                }
            });
        }
    }
    function deleteTempDetailKartuKeluarga(NIK){
        const familyCard_id = $('#familyCard_id').val();
        Swal.fire({
            title: 'Peringatan',
            text: "Data akan terhapus secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText : 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : '<?= url('/adm/dataJemaat/deleteTempDetailKartuKeluarga') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {NIK : NIK},
                    method : 'POST',
                    success:function(data){
                        if(data == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil dihapus',
                                showConfirmButton: false,   
                                timer: 1500
                            });
                        }
                        getDetailKartuKeluarga(familyCard_id);
                    }
                });      
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Batal',
                    text: 'Data batal dihapus',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }
    function deleteDetailKartuKeluarga(NIK){
        const familyCard_id = $('#familyCard_id').val();
        Swal.fire({
            title: 'Peringatan',
            text: "Data akan terhapus secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText : 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : '<?= url('/adm/dataJemaat/deleteDetailKartuKeluarga') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {NIK : NIK},
                    method : 'POST',
                    success:function(data){
                        if(data == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil dihapus',
                                showConfirmButton: false,   
                                timer: 1500
                            });
                        }
                        getDetailKartuKeluarga(familyCard_id);
                    }
                });      
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Batal',
                    text: 'Data batal dihapus',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }
    function deleteKartuKeluarga(familyCard_id){
        Swal.fire({
            title: 'Peringatan',
            text: "Data akan terhapus secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText : 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : '<?= url('/adm/dataJemaat/deleteKartuKeluarga') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {familyCard_id : familyCard_id},
                    method : 'POST',
                    success:function(data){
                        if(data == "success"){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil dihapus',
                                showConfirmButton: false,   
                                timer: 1500
                            });
                        }
                        getDataKartuKeluarga();
                    }
                });      
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Batal',
                    text: 'Data batal dihapus',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }
</script>
@endpush