@extends('Layouts.app',['title' => 'Sion WKO| Data Jemaat - Baptis'])
@section('content')
@include('DataJemaat.Baptis.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row"> 
                <div class="text-left float-left col-lg-2 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahBaptisModal()"> <i class="fas fa-plus-circle"></i> Tambah Baptis</a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> ID Baptis </th>
                            <th> Nama </th>
                            <th> TTL </th>
                            <th> Tanggal Baptis </th>
                            <th> Pembaptis </th>
                            <th> Jenis Kelamin </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataBaptis">

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
    var last_index = '{{$baptis->lastPage()}}';
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
            getDataBaptis();
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
        getDataBaptis();
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
            getDataBaptis();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    $(document).ready(function(){
        getDataBaptis();
    });
    function getDataBaptis(){
        $.ajax({
            url : '<?= url('/adm/dataJemaat/getAllBaptis') ?>',
            method : 'POST',
            data : {page:current_page_index },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataBaptis').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahBaptisModal(){
        document.getElementById('cmd').value = "add";
        $('#addBaptis').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Baptis');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $('#tampilBaptisModal').attr('action','<?= '/adm/dataJemaat/createBaptis'?> ');
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showBaptisModel') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {cmd : $('#cmd').val()},
            method : 'POST',
            success:function(data){
                $('#isiBaptisModal').html(data);
            }
        });
    }
    function editBaptisModal(baptism_id){
        document.getElementById('cmd').value = "edit";
        $('#addBaptis').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Edit Baptis');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Edit Data');
        $('#tampilBaptisModal').attr('action','<?= '/adm/dataJemaat/updateBaptis'?> ');
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showBaptisModel') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {cmd : $('#cmd').val(), baptism_id : baptism_id},
            method : 'POST',
            success:function(data){
                $('#isiBaptisModal').html(data);
            }
        });
    }
    function deleteBaptis(baptism_id){
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
                    url : '<?= url('/adm/dataJemaat/deleteBaptis') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {baptism_id : baptism_id},
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
                        getDataBaptis();
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