@extends('Layouts.app',['title' => 'Sion WKO| Pelayan - Majelis Ibadah Minggu'])
@section('content')
@include('Pelayan.Pembagian Tugas.Majelis Ibadah Minggu.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahMajelisIbadahMingguModal()"> <i class="fas fa-plus-circle"></i> Tambah Majelis Ibadah Minggu </a>
                </div>
                <div class="text-left float-left col-lg-3 col-4">
                   <select class="form-control" name="chooseMajelisIbadahMinggu" id="chooseMajelisIbadahMinggu">
                        <option value="-"> -- PILIH -- </option>
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
                            <th> ID Majelis </th>
                            <th> Majelis </th>
                            <th> Koor </th>
                            <th> Pendamping Khadim </th>
                            <th> Seragam </th>
                            <th> Tanggal & Waktu </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataMajelisIbadahMinggu">

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
    var last_index = '{{$majelisIbadahMinggu->lastPage()}}';
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
            getDataMajelisIbadahMinggu();
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
        getDataMajelisIbadahMinggu();
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
            getDataMajelisIbadahMinggu();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    $(document).ready(function(){
        getDataMajelisIbadahMinggu();
    });
    $('#chooseMajelisIbadahMinggu').change(function(){
        getDataMajelisIbadahMinggu();
    });
    function getDataMajelisIbadahMinggu(){
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/majelisIbadahMinggu/getAllMajelisIbadahMinggu') ?>' ,
            method : 'POST',
            data : {
                chooseMajelisIbadahMinggu : $('#chooseMajelisIbadahMinggu').val(),
                page : current_page_index 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataMajelisIbadahMinggu').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahMajelisIbadahMingguModal(){
        document.getElementById('cmd').value = "add";
        $('#viewMajelisIbadahMingguModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Majelis Ibadah Minggu');
        $('#tampilMajelisIbadahMingguModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/majelisIbadahMinggu/createMajelisIbadahMinggu' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/majelisIbadahMinggu/showMajelisIbadahMingguModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalMajelisIbadahMinggu').html(data);
            }
        });
    }
    function editMajelisIbadahMingguModal(assembly_id){
        document.getElementById('cmd').value = "edit";
        $('#viewMajelisIbadahMingguModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Majelis Ibadah Minggu');
        $('#tampilMajelisIbadahMingguModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/majelisIbadahMinggu/updateMajelisIbadahMinggu' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/majelisIbadahMinggu/showMajelisIbadahMingguModel') ?>',
            data : {cmd : $('#cmd').val(), assembly_id : assembly_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalMajelisIbadahMinggu').html(data);
            }
        });
    }
    function deleteMajelisIbadahMinggu(assembly_id){
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
                    url : '<?= url('/adm/pelayanan/pembagianTugas/majelisIbadahMinggu/deleteMajelisIbadahMinggu') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {assembly_id : assembly_id},
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
                        getDataMajelisIbadahMinggu();
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