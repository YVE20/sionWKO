@extends('Layouts.app',['title' => 'Sion WKO| Pelayan - Penerima Tamu'])
@section('content')
@include('Pelayan.Pembagian Tugas.Penerima Tamu.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahPenerimaTamuModal()"> <i class="fas fa-plus-circle"></i> Tambah PenerimaTamu </a>
                </div>
                <div class="text-left float-left col-lg-3 col-4">
                    <input type="text" class="form-control" name="searchPenerimaTamu" id="searchPenerimaTamu" placeholder="Search                                                 &#128269;">
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> ID Penerima Tamu </th>
                            <th> Penerima Tamu </th>
                            <th> Tanggal & Waktu </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataPenerimaTamu">

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
    var last_index = '{{$penerimaTamu->lastPage()}}';
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
            getDataPenerimaTamu();
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
        getDataPenerimaTamu();
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
            getDataPenerimaTamu();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    } 
    $(document).ready(function(){
        getDataPenerimaTamu();
    });
    $('#searchPenerimaTamu').keyup(function(){
        getDataPenerimaTamu();
    });
    function getDataPenerimaTamu(){
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/penerimaTamu/getAllPenerimaTamu') ?>' ,
            method : 'POST',
            data : {
                searchPenerimaTamu : $('#searchPenerimaTamu').val(),
                page:current_page_index 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataPenerimaTamu').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahPenerimaTamuModal(){
        document.getElementById('cmd').value = "add";
        $('#viewPenerimaTamuModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah PenerimaTamu');
        $('#tampilPenerimaTamuModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/penerimaTamu/createPenerimaTamu' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/penerimaTamu/showPenerimaTamuModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalPenerimaTamu').html(data);
            }
        });
    }
    function editPenerimaTamuModal(welcoming_id){
        document.getElementById('cmd').value = "edit";
        $('#viewPenerimaTamuModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit PenerimaTamu');
        $('#tampilPenerimaTamuModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/penerimaTamu/updatePenerimaTamu' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/penerimaTamu/showPenerimaTamuModel') ?>',
            data : {cmd : $('#cmd').val(), welcoming_id : welcoming_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalPenerimaTamu').html(data);
            }
        });
    }
    function deletePenerimaTamu(welcoming_id){
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
                    url : '<?= url('/adm/pelayanan/pembagianTugas/penerimaTamu/deletePenerimaTamu') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {welcoming_id : welcoming_id},
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
                        getDataPenerimaTamu();
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