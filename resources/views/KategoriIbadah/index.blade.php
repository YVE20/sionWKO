@extends('Layouts.app',['title' => 'Sion WKO| Dashboard'])
@section('content')
@include('KategoriIbadah.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="text-left col-lg-2 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahIbadahModal()"> <i class="fas fa-plus-circle"></i> Tambah Ibadah</a>
                </div>
                <div class="text-left col-lg-2 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahKategoriIbadahModal()" data-toggle="modal" data-target="#jenisModal"> <i class="fas fa-plus-circle"></i> Tambah Kategori </a>
                </div>
                <div class="text-left text-center col-lg-2 col-4">
                    <a class="btn btn-secondary w-100" href="javascript:void(0)" onclick="viewKategoriIbadahModal()" style="white-space: nowrap;" data-toggle="modal" data-target="#viewjenisModal"> <i class="far fa-eye"></i> Lihat Kategori </a>
                </div>
                <div class="text-left col-lg-3 col-4">
                    <div class="row">
                        <div class="col-lg-10" id="divIbadahOnly">
                            <select class="form-control" name="chooseIbadah" id="chooseIbadah">
                                <option value="-"> -- Pilih Ibadah -- </option>
                                <option value="IBD/IBKB/2022"> Ibadah Kaum Bapak </option>
                                <option value="IBD/IBKI/2022"> Ibadah Kaum Ibu </option>
                                <option value="IBD/IBM/2022"> Ibadah Minggu </option>
                                <option value="IBD/IBASM/2022"> Ibadah Anak Sekolah Minggu </option>
                                <option value="IBD/IBLP/2022"> Ibadah Lingkungan Pelayan </option>
                                <option value="IBD/IBMG/2022"> Ibadah Minggu Gembira </option>
                                <option value="IBD/IBP/2022"> Ibadah Pemuda </option>
                                <option value="IBD/IBR/2022"> Ibadah Remaja </option>
                                <option value="IBD/IBLL/2022"> Ibadah Lain-lain </option>
                            </select>
                        </div>
                        <div class="col-lg-2" id="cleanIbadahOnly">
                            <button id="clean" class="btn btn-secondary"> <i class="fas fa-eraser"></i> </button>
                        </div>
                    </div>
                </div>
                <div class="text-left col-lg-2 col-4" id="divLingkunganPelayanan" style="display:none">
                    <div class="row">
                        <div class="col-lg-10">
                            <select class="form-control" style="display:none;" name="chooseLingkunganPelayanan" id="chooseLingkunganPelayanan">
                                <option value="-"> -- Pilih LP --  </option>
                                <option value="1"> LP 1 </option>
                                <option value="2"> LP 2 </option>
                                <option value="3"> LP 3 </option>
                                <option value="4"> LP 4 </option>
                                <option value="5"> LP 5 </option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <button id="clean" class="btn btn-secondary"> <i class="fas fa-eraser"></i> </button>
                        </div>
                    </div>
                </div>
                <div class="text-left col-lg-2 col-4" id="divJenisIbadah" style="display:none;">
                    <div class="row">
                        <div class="col-lg-10">
                            <select class="form-control" style="display:none;" name="chooseJenisIbadah" id="chooseJenisIbadah">
                                <option value="-"> -- Pilih --  </option>
                                <option value="Ibadah Keluarga Pelayan"> Ibadah Keluarga Pelayan </option>
                                <option value="Ibadah Pelajar"> Ibadah Pelajar </option>
                                <option value="Ibadah Usinda"> Ibadah Usinda </option>
                                <option value="Ibadah Pergumulan MJ"> Ibadah Pergumulan MJ </option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <button id="clean" class="btn btn-secondary"> <i class="fas fa-eraser"></i> </button>
                        </div>
                    </div>
                </div>
            </div>       
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Kategori ID </th>
                            <th> Pelayan </th>
                            <th> Judul Khotbah </th>
                            <th> Tempat </th>
                            <th> Tanggal & Waktu </th>
                            <th> PIC </th>
                            <th> LP </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataWorship">

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
    var last_index = '{{$kategoriIbadah->lastPage()}}';
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
            getDataIbadah();
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
        getDataIbadah();
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
            getDataIbadah();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    tinymce.init({
        selector: '#sermon_content'
    });
    $(document).ready(function(){
        getDataIbadah();
    });
    $('#clean').click(function(){
        resetDataIbadah();
    });
    $('#chooseIbadah').change(function(){
        $('#chooseLingkunganPelayanan').val("-");
        $('#chooseJenisIbadah').val("-");
        getDataIbadah();
        if($('#chooseIbadah').val() == "IBD/IBKB/2022" || $('#chooseIbadah').val() == "IBD/IBKI/2022" || $('#chooseIbadah').val() == "IBD/IBMG/2022" || $('#chooseIbadah').val() == "IBD/IBLP/2022"){
            $('#chooseLingkunganPelayanan').css('display','block');
            $('#divLingkunganPelayanan').css('display','block');
            $('#chooseJenisIbadah').css('display','none');
            $('#divJenisIbadah').css('display','none')
            $('#cleanIbadahOnly').css('display','none');
            $('#divIbadahOnly').removeClass('col-lg-10');
            $('#divIbadahOnly').addClass('col-lg-12');
            $('#chooseLingkunganPelayanan').change(function(){
                getDataIbadah();
            });
            $('#chooseLingkunganPelayanan').val("-");
        }else if($('#chooseIbadah').val() == "IBD/IBLL/2022"){
            $('#chooseJenisIbadah').css('display','block');
            $('#divJenisIbadah').css('display','block')
            $('#chooseLingkunganPelayanan').css('display','none');
            $('#divLingkunganPelayanan').css('display','none');
            $('#divIbadahOnly').removeClass('col-lg-10');
            $('#divIbadahOnly').addClass('col-lg-12');
            $('#cleanIbadahOnly').css('display','none');
            $('#chooseJenisIbadah').change(function(){
                getDataIbadah();
            });
        }else{
            $('#chooseLingkunganPelayanan').css('display','none');
            $('#divLingkunganPelayanan').css('display','none');
            $('#chooseLingkunganPelayanan').val("-");
            $('#chooseJenisIbadah').css('display','none');
            $('#divJenisIbadah').css('display','none')
            $('#chooseJenisIbadah').val("-");
            $('#cleanIbadahOnly').css('display','block');
            $('#divIbadahOnly').removeClass('col-lg-12');
            $('#divIbadahOnly').addClass('col-lg-10');
        }
    });
    function viewKategoriIbadahModal(){
        $('#viewKategoriIbadahModal').modal('show');
        getDataKategoriIbadah();
    }
    function tambahIbadahModal(){
        $('#addIbadahModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Ibadah');
        $('#tampilModalIbadah').attr('action','<?= '/adm/ibadah/createIbadah' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/ibadah/showIbadahModel') ?>',
            data : {worship_id : ""},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalIbadah').html(data);
                tinymce.init({
                    selector: '#sermon_content'
                });
            }
        });
    }
    function tambahKategoriIbadahModal(){
        document.getElementById('cmd').value = "add";
        $('#addKategoriIbadahModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Kategori Ibadah');
        $('#tampilKategoriModalIbadah').attr('action','<?= '/adm/ibadah/createKategoriIbadah' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/ibadah/showKategoriIbadahModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalKategoriIbadah').html(data);
            }
        });
    }
    function editIbadahModal(worship_id){
        document.getElementById('cmd').value = "edit";
        $('#addIbadahModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Ibadah');
        $('#tampilModalIbadah').attr('action','<?= '/adm/ibadah/updateIbadah' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/ibadah/showIbadahModel') ?>',
            data : {worship_id : worship_id, cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalIbadah').html(data);
                tinymce.init({
                    selector: '#sermon_content'
                });
                pilihKategoriIbadah();
            }
        });
    }
    function editKategoriIbadah(category_id){
        document.getElementById('cmd').value = "edit";
        $('#viewKategoriIbadahModal').modal('hide');
        $('#addKategoriIbadahModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Kategori Ibadah');
        $('#tampilKategoriModalIbadah').attr('action','<?= '/adm/ibadah/updateKategoriIbadah' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/ibadah/showKategoriIbadahModel') ?>',
            data : {category_id : category_id, cmd : $('#cmd').val() },
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $('#isiModalKategoriIbadah').html(data);
            }
        });
    }
    function pilihKategoriIbadah(){
        const category_id = $('#category_id').val();
        $.ajax({
            url : '<?= url('/adm/ibadah/getWorshipByCategoryId') ?>',
            data : {category_id : category_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            dataType : 'JSON',
            success:function(data){
                console.log(data);
                $('#category').val(data.category);
                var worship = $('#worship');

                if(data.category == "Ibadah Lain-lain"){
                    worship.prop('readonly',false);
                    worship.css('display','block');
                }else{
                    if(data.category_id == "IBD/IBLP/2022"){
                        $('#service_environtment').css('display','block');
                        $("#service_environtment").prop('required',true);
                    }
                    else if(data.category_id == "IBD/IBKB/2022"){
                        $('#service_environtment').css('display','block');
                        $("#service_environtment").prop('required',true);
                    }
                    else if(data.category_id == "IBD/IBKI/2022"){
                        $('#service_environtment').css('display','block');
                        $("#service_environtment").prop('required',true);
                    }else if(data.category_id == "IBD/IBMG/2022"){
                        $('#service_environtment').css('display','block');
                        $("#service_environtment").prop('required',true);
                    }else{
                        $('#service_environtment').css('display','none');
                        worship.css('display','none');
                    }   
                }
            }
        }); 
    }
    function resetDataIbadah(){
        $.ajax({
            url : '<?= url('/adm/ibadah/getAllWorship') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {
                chooseIbadah : "",
                chooseLingkunganPelayanan : "",
                chooseJenisIbadah : "",
                page:current_page_index 
            },
            method : 'POST',
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataWorship').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
                $('#chooseIbadah').val("-");
                $('#chooseLingkunganPelayanan').val("-");
                $('#chooseLingkunganPelayanan').css('display','none');
                $('#chooseLingkunganPelayanan').val("-");
                $('#chooseJenisIbadah').val("-");
                $('#chooseJenisIbadah').css('display','none');
                $('#chooseJenisIbadah').val("-");
            }
        });
    }
    function getDataIbadah(){
        $.ajax({
            url : '<?= url('/adm/ibadah/getAllWorship') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {
                chooseIbadah : $('#chooseIbadah').val(),
                chooseLingkunganPelayanan : $('#chooseLingkunganPelayanan').val(),
                chooseJenisIbadah : $('#chooseJenisIbadah').val(),
                page:current_page_index 
            },
            method : 'POST',
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataWorship').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function getDataKategoriIbadah(){
        $.ajax({
            url : '<?= url('/adm/ibadah/getAllKategoriIbadah') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiKategoriIbadah').html(data);
                getDataKategoriIbadah();
            }
        });
    }
    function deleteKategoriIbadah(category_id){
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
                    url : '<?= url('/adm/ibadah/deleteKategoriIbadah') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {category_id : category_id},
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
                        getDataIbadah();
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
        })
    }
    function deleteIbadah(worship_id){
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
                    url : '<?= url('/adm/ibadah/deleteIbadah') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {worship_id : worship_id},
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
                        getDataIbadah();
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
        })
    }
</script>
@endpush