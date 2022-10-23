@extends('layouts.app',['title' => 'Sion WKO| Event - HUT'])
@section('content')
@include('Event.HUT.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-2 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahHUTModal()"> <i class="fas fa-plus-circle"></i> Tambah HUT </a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> ID Event </th>
                            <th> Kategori </th>
                            <th> Tanggal </th>
                            <th> Alamat </th>
                            <th> Tema </th>
                            <th> Narahubung </th>
                            <th> Foto </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataHUT">

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
    var last_index = '{{$HUT->lastPage()}}';
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
            getDataEventHUT();
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
        getDataEventHUT();
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
            getDataEventHUT();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    $(document).ready(function(){
        getDataEventHUT();
    });
    function getDataEventHUT(){
        $.ajax({
            url : '<?= url('/adm/event/getAllHUT') ?>' ,
            method : 'POST',
            data : {page:current_page_index },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataHUT').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahHUTModal(){
        document.getElementById('cmd').value = "add";
        $('#addHUTModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah HUT');
        $('#tampilHUTModal').attr('action','<?= '/adm/event/createHUT' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/event/showAllEventModel') ?>',
            data : {cmd : $('#cmd').val(), kategoriEvent : $('#kategoriEvent').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalHUT').html(data);
            }
        });
    }
    function editHUTModel(event_id){
        document.getElementById('cmd').value = "edit";
        $('#addHUTModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit HUT');
        $('#tampilHUTModal').attr('action','<?= '/adm/event/updateHUT' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/event/showAllEventModel') ?>',
            data : {cmd : $('#cmd').val(), kategoriEvent : $('#kategoriEvent').val(), event_id : event_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalHUT').html(data);
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
    function deteleHUT(event_id){
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
                    url : '<?= url('/adm/event/deleteHUT') ?>',
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
                        getDataEventHUT();
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