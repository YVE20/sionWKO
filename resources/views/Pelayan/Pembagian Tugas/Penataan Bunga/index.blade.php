@extends('layouts.app',['title' => 'Sion WKO| Pelayan - Penataan Bunga'])
@section('content')
@include('Pelayan.Pembagian Tugas.Penataan Bunga.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahPenataanBungaModal()"> <i class="fas fa-plus-circle"></i> Tambah Penataan Bunga </a>
                </div>
                <div class="text-left float-left col-lg-3 col-4">
                   <select class="form-control" name="chooseLingkunganPelayanan" id="chooseLingkunganPelayanan">
                        <option value="-"> -- Pilih Lingkungan Pelayanan -- </option>
                        <option value="1"> Lingkungan Pelayanan 1 </option>
                        <option value="2"> Lingkungan Pelayanan 2 </option>
                        <option value="3"> Lingkungan Pelayanan 3 </option>
                        <option value="4"> Lingkungan Pelayanan 4 </option>
                        <option value="5"> Lingkungan Pelayanan 5 </option>
                   </select>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> ID Penata </th>
                            <th> Kaum Ibu Bertugas </th>
                            <th> Koor </th>
                            <th> Tanggal & Waktu </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataPenataanBunga">

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
    var last_index = '{{$penataanBunga->lastPage()}}';
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
            getDataPenataanBunga();
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
        getDataPenataanBunga();
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
            getDataPenataanBunga();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    $('#chooseLingkunganPelayanan').keyup(function(){
        getDataPenataanBunga();
    });
    $(document).ready(function(){
        getDataPenataanBunga();
    });
    function getDataPenataanBunga(){
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/penataanBunga/getAllPenataanBunga') ?>' ,
            method : 'POST',
            data : {
                chooseLingkunganPelayanan : $('#chooseLingkunganPelayanan').val(),
                page:current_page_index 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#isiDataPenataanBunga').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahPenataanBungaModal(){
        document.getElementById('cmd').value = "add";
        $('#viewPenataanBungaModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Penataan Bunga');
        $('#tampilPenataanBungaModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/penataanBunga/createPenataanBunga' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/penataanBunga/showPenataanBungaModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalPenataanBunga').html(data);
            }
        });
    }
    function editPenataanBungaModal(flowerArrangement_id){
        document.getElementById('cmd').value = "edit";
        $('#viewPenataanBungaModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Penataan Bunga');
        $('#tampilPenataanBungaModal').attr('action','<?= '/adm/pelayanan/pembagianTugas/penataanBunga/updatePenataanBunga' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/pelayanan/pembagianTugas/penataanBunga/showPenataanBungaModel') ?>',
            data : {cmd : $('#cmd').val(), flowerArrangement_id : flowerArrangement_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalPenataanBunga').html(data);
            }
        });
    }
    function deletePenataanBunga(flowerArrangement_id){
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
                    url : '<?= url('/adm/pelayanan/pembagianTugas/penataanBunga/deletePenataanBunga') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {flowerArrangement_id : flowerArrangement_id},
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
                        getDataPenataanBunga();
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