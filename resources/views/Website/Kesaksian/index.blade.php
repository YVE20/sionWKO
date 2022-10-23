@extends('Layouts.app',['title' => 'Sion WKO| Website - Kesaksian'])
@section('content')
@include('Website.Kesaksian.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-2 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahKesaksianModal()"> <i class="fas fa-plus-circle"></i> Tambah Kesaksian</a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <colgroup>
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="35%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th> ID Kesaksian </th>
                            <th> Nama </th>
                            <th> Email </th>
                            <th> Judul </th>
                            <th> Isi </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataKesaksian">

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
    var last_index = '{{$kesaksian->lastPage()}}';
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
        getDataKesaksian();
        tinymce.init({
            selector: 'textarea#message'
        });
    });
    
    function pagination_prev(){
        if(current_page_index != 1){
            current_page_index -= 1;
            getDataKesaksian();
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
        getDataKesaksian();
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
            getDataKesaksian();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    function getDataKesaksian(){
        $.ajax({
            url : '<?= url('/adm/website/getAllKesaksian') ?>' ,
            method : 'POST',
            data : {page:current_page_index },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataKesaksian').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahKesaksianModal(){
        document.getElementById('cmd').value = "add";
        $('#addKesaksianModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Kesaksian');
        $('#tampilModalKesaksian').attr('action','<?= '/adm/website/createKesaksian' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/website/showKesaksianModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalKesaksian').html(data);
            }
        });
    }
    function editKesaksianModal(testimony_id){
        document.getElementById('cmd').value = "edit";
        $('#addKesaksianModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Kesaksian');
        $('#tampilModalKesaksian').attr('action','<?= '/adm/website/updateKesaksian' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/website/showKesaksianModel') ?>',
            data : {cmd : $('#cmd').val(),testimony_id : testimony_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalKesaksian').html(data);
            }
        });
    }
    function deleteKesaksian(testimony_id){
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
                    url : '<?= url('/adm/website/deleteKesaksian') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {testimony_id : testimony_id},
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
                        getDataKesaksian();
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