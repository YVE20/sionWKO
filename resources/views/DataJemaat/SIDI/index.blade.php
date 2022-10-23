<<<<<<< HEAD
@extends('layouts.app',['title' => 'Sion WKO| Data Jemaat - SIDI'])
=======
@extends('Layouts.app',['title' => 'Sion WKO| Data Jemaat - SIDI'])
>>>>>>> e31524c9c0cb566971c2c2d7d469a6cb9f1aac23
@section('content')
@include('DataJemaat.SIDI.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-2 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahSIDIModal()"> <i class="fas fa-plus-circle"></i> Tambah SIDI</a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> ID SIDI </th>
                            <th> NIK </th>
                            <th> Nama </th>
                            <th> TTL </th>
                            <th> No Telp </th>
                            <th> Baptis </th>
                            <th> Nikah </th>
                            <th> Foto </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataSIDI">

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
    var last_index = '{{$sidi->lastPage()}}';
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
        getDataSIDI();
    });
    function pagination_prev(){
        if(current_page_index != 1){
            current_page_index -= 1;
            getDataSIDI();
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
        getDataSIDI();
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
            getDataSIDI();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    function getDataSIDI(){
        $.ajax({
            url : '<?= url('/adm/dataJemaat/getAllSIDI') ?>' ,
            method : 'POST',
            data : {page:current_page_index },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataSIDI').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahSIDIModal(){
        document.getElementById('cmd').value = "add";
        $('#addSIDIModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah SIDI');
        $('#tampilModalSIDI').attr('action','<?= '/adm/dataJemaat/createSIDI' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showSIDIModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalSIDI').html(data);
            }
        });
    }
    function editSIDIModal(sidi_id){
        document.getElementById('cmd').value = "edit";
        $('#addSIDIModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit SIDI');
        $('#tampilModalSIDI').attr('action','<?= '/adm/dataJemaat/updateSIDI' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showSIDIModel') ?>',
            data : {cmd : $('#cmd').val(),sidi_id : sidi_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalSIDI').html(data);
            }
        });
    }
    function deleteSIDI(sidi_id){
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
                    url : '<?= url('/adm/dataJemaat/deleteSIDI') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {sidi_id : sidi_id},
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
                        getDataSIDI();
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