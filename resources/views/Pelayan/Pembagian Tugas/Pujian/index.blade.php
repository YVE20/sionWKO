<<<<<<< HEAD
@extends('layouts.app',['title' => 'Sion WKO| Pelayan - Pujian'])
=======
@extends('Layouts.app',['title' => 'Sion WKO| Pelayan - Pujian'])
>>>>>>> e31524c9c0cb566971c2c2d7d469a6cb9f1aac23
@section('content')
@include('Pelayan.Pembagian Tugas.Pujian.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahPujianModal()"> <i class="fas fa-plus-circle"></i> Tambah Pujian </a>
                </div>
                <div class="text-left float-left col-lg-3 col-4">
                    <input type="text" class="form-control" name="searchSinger" id="searchSinger" placeholder="Search Singer                                      &#128269;">
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> ID Pujian </th>
                            <th> Singer </th>
                            <th> Tanggal & Waktu </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataPujian">

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
    var last_index = '{{$pujian->lastPage()}}';
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
    $(document).ready(function(){
        getDataPujian();
    });
    $('#searchSinger').keyup(function(){
        getDataPujian();
    });
    function pagination_prev(){
        if(current_page_index != 1){
            current_page_index -= 1;
            getDataPujian();
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
        getDataPujian();
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
            getDataPujian();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    function getDataPujian(){
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/pujian/getAllPujian') ?>' ,
            method : 'POST',
            data : {
                searchSinger : $('#searchSinger').val(),
                page:current_page_index 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataPujian').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahPujianModal(){
        document.getElementById('cmd').value = "add";
        $('#viewPujianModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Pujian');
        $('#tampilPujianModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/pujian/createPujian' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/pujian/showPujianModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalPujian').html(data);
            }
        });
    }
    function editPujianModal(singing_id){
        document.getElementById('cmd').value = "edit";
        $('#viewPujianModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Pujian');
        $('#tampilPujianModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/pujian/updatePujian' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/pujian/showPujianModel') ?>',
            data : {cmd : $('#cmd').val(), singing_id : singing_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalPujian').html(data);
            }
        });
    }
    function deletePujian(singing_id){
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
                    url : '<?= url('/adm/pelayanan/pembagianTugas/pujian/deletePujian') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {singing_id : singing_id},
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
                        getDataPujian();
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