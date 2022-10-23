@extends('layouts.app',['title' => 'Sion WKO| Pelayan - Khadim'])
@section('content')
@include('Pelayan.Pembagian Tugas.Khadim.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahKhadimModal()"> <i class="fas fa-plus-circle"></i> Tambah Khadim </a>
                </div>
                 <div class="text-left float-left col-lg-3 col-4">
                    <input type="text" class="form-control" name="searchKhadim" id="searchKhadim" placeholder="Search Khadim                                    &#128269;">
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> ID Khadim </th>
                            <th> Tema </th>
                            <th> Khadim </th>
                            <th> Tanggal & Waktu </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataKhadim">

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
    var last_index = '{{$khadim->lastPage()}}';
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
            getDataKhadim();
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
        getDataKhadim();
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
            getDataKhadim();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    $(document).ready(function(){
        getDataKhadim();
    });
    $('#searchKhadim').keyup(function(){
        getDataKhadim();
    });
    function getDataKhadim(){
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/khadim/getAllKhadim') ?>' ,
            method : 'POST',
            data : {
                searchKhadim : $('#searchKhadim').val(),
                page:current_page_index 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataKhadim').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahKhadimModal(){
        document.getElementById('cmd').value = "add";
        $('#viewKhadimModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Khadim');
        $('#tampilKhadimModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/khadim/createKhadim' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/khadim/showKhadimModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalKhadim').html(data);
            }
        });
    }
    function editKhadimModal(khadim_id){
        document.getElementById('cmd').value = "edit";
        $('#viewKhadimModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Khadim');
        $('#tampilKhadimModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/khadim/updateKhadim' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/khadim/showKhadimModel') ?>',
            data : {cmd : $('#cmd').val(), khadim_id : khadim_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalKhadim').html(data);
            }
        });
    }
    function deleteKhadim(khadim_id){
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
                    url : '<?= url('/adm/pelayanan/pembagianTugas/khadim/deleteKhadim') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {khadim_id : khadim_id},
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
                        getDataKhadim();
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