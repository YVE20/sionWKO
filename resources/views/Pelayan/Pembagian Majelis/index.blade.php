<<<<<<< HEAD
@extends('layouts.app',['title' => 'Sion WKO| Pelayan - Pembagian Majelis'])
=======
@extends('Layouts.app',['title' => 'Sion WKO| Pelayan - Pembagian Majelis'])
>>>>>>> e31524c9c0cb566971c2c2d7d469a6cb9f1aac23
@section('content')
@include('Pelayan.Pembagian Majelis.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahPembagianMajelisModal()"> <i class="fas fa-plus-circle"></i> Tambah Pembagian Majelis </a>
                </div>
                <div class="text-left float-left col-lg-3 col-4">
                    <input type="text" class="form-control" name="searchPembagianMajelis" id="searchPembagianMajelis" placeholder="Search                                                 &#128269;">
                </div>
                <div class="text-left float-left col-lg-3 col-4">
                   <select class="form-control" name="choosePembagianMajelis" id="choosePembagianMajelis">
                        <option value="Kelompok 1"> Kelompok 1 </option>
                        <option value="Kelompok 2"> Kelompok 2 </option>
                   </select>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> ID Pembagian Majelis </th>
                            <th> Majelis </th>
                            <th> Kelompok </th>
                            <th> Ibadah </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataPembagianMajelis">

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
    var last_index = '{{$pembagianMajelis->lastPage()}}';
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
            getDataPembagianMajelis();
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
        getDataPembagianMajelis();
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
            getDataPembagianMajelis();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    $(document).ready(function(){
        getDataPembagianMajelis();
    });
    $('#searchPembagianMajelis').keyup(function(){
        getDataPembagianMajelis();
    });
    $('#choosePembagianMajelis').change(function(){
        getDataPembagianMajelis();
    });
    function getDataPembagianMajelis(){
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianMajelis/getAllPembagianMajelis') ?>' ,
            method : 'POST',
            data : {
                searchPembagianMajelis : $('#searchPembagianMajelis').val(),
                choosePembagianMajelis : $('#choosePembagianMajelis').val(),
                page : current_page_index 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataPembagianMajelis').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahPembagianMajelisModal(){
        document.getElementById('cmd').value = "add";
        $('#viewPembagianMajelisModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Pembagian Majelis');
        $('#tampilPembagianMajelisModal').attr('action','<?= '/adm/pelayanan/pembagianMajelis/createPembagianMajelis' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianMajelis/showPembagianMajelisModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalPembagianMajelis').html(data);
            }
        });
    }
    function editPembagianMajelisModal(assemblyData_id){
        document.getElementById('cmd').value = "edit";
        $('#viewPembagianMajelisModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Pembagian Majelis');
        $('#tampilPembagianMajelisModal').attr('action','<?= '/adm/pelayanan/pembagianMajelis/updatePembagianMajelis' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianMajelis/showPembagianMajelisModel') ?>',
            data : {cmd : $('#cmd').val(), assemblyData_id : assemblyData_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalPembagianMajelis').html(data);
            }
        });
    }
    function deletePembagianMajelis(assemblyData_id){
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
                    url : '<?= url('/adm/pelayanan/pembagianMajelis/deletePembagianMajelis') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {assemblyData_id : assemblyData_id},
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
                        getDataPembagianMajelis();
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