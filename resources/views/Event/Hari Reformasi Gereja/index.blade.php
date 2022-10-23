<<<<<<< HEAD
@extends('layouts.app',['title' => 'Sion WKO| Event - Hari Reformasi Gereja'])
=======
@extends('Layouts.app',['title' => 'Sion WKO| Event - Hari Reformasi Gereja'])
>>>>>>> e31524c9c0cb566971c2c2d7d469a6cb9f1aac23
@section('content')
@include('Event.Hari Reformasi Gereja.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahReformasiGerejaModal()"> <i class="fas fa-plus-circle"></i> Tambah Reformasi Gereja </a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> ID Event </th>
                            <th> Tanggal </th>
                            <th> Alamat </th>
                            <th> Tema </th>
                            <th> Narahubung </th>
                            <th> Foto </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataReformasiGereja">

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
    var last_index = '{{$reformasiGereja->lastPage()}}';
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
            getDataEventReformasiGereja();
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
        getDataEventReformasiGereja();
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
            getDataEventReformasiGereja();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    $(document).ready(function(){
        getDataEventReformasiGereja();
    });
    function getDataEventReformasiGereja(){
        $.ajax({
            url : '<?= url('/adm/event/getAllReformasiGereja') ?>' ,
            method : 'POST',
            data : {page:current_page_index },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataReformasiGereja').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahReformasiGerejaModal(){
        document.getElementById('cmd').value = "add";
        $('#addReformasiGerejaModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Reformasi Gereja');
        $('#tampilReformasiGerejaModal').attr('action','<?= '/adm/event/createReformasiGereja' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/event/showAllEventModel') ?>',
            data : {cmd : $('#cmd').val(), kategoriEvent : $('#kategoriEvent').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalReformasiGereja').html(data);
            }
        });
    }
    function editReformasiGerejaModel(event_id){
        document.getElementById('cmd').value = "edit";
        $('#addReformasiGerejaModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Reformasi Gereja');
        $('#tampilReformasiGerejaModal').attr('action','<?= '/adm/event/updateReformasiGereja' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/event/showAllEventModel') ?>',
            data : {cmd : $('#cmd').val(), kategoriEvent : $('#kategoriEvent').val(), event_id : event_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalReformasiGereja').html(data);
            }
        });
    }
    function pilihKategoriEvent(){
        const eventCategory_id = $('#eventCategory_id').val();
        $.ajax({
            url : '<?= url('/adm/event/getEventByEventCategoryId') ?>',
            data : {eventCategory_id : eventCategory_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#even').val(data.event);
            }
        }); 
    }
    function deteleReformasiGereja(event_id){
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
                    url : '<?= url('/adm/event/deleteReformasiGereja') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {event_id : event_id},
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
                        getDataEventReformasiGereja();
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