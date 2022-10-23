@extends('Layouts.app',['title' => 'Sion WKO| Data Jemat'])
@section('content')
@include('DataJemaat.Manage Jemaat.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
           <div class="row"> 
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-primary w-100" href="javascript:void(0)" onclick="tambahDataJemaatModal()"> <i class="fas fa-plus-circle"></i> Tambah Data Jemaat </a>
                </div>
                <div class="text-left float-left col-lg-3 col-4">
                    <a class="btn btn-success" href="javascript:void(0)" onclick="downloadDataJemaat()"> <i class="fas fa-file-pdf"></i> Download </a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> ID Jemaat </th>
                            <th> Baptis </th>
                            <th> SIDI </th>
                            <th> KK </th>
                            <th> LP </th>
                            <th> Action </th>
                        </th>
                    </thead>
                    <tbody id="isiDataJemaat">

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
    var last_index = '{{$dataJemaat->lastPage()}}';
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
        getDataJemaat();
    });
    function pagination_prev(){
        if(current_page_index != 1){
            current_page_index -= 1;
            getDataJemaat();
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
        getDataJemaat();
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
            getDataJemaat();
            $('.page-item-number').removeClass('active');
            $($('.page-item-number')[current_page_index - 1]).addClass('active');
            $('.page-nav').removeClass('disabled');
            if(current_page_index == last_index){
                $(this).addClass('disabled');
            }
        }
    }
    function getDataJemaat(){
        $.ajax({
            url : '<?= url('/adm/dataJemaat/getAllDataJemaat') ?>' ,
            method : 'POST',
             data : {page:current_page_index },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                console.log(data);
                var arr_data = data.split('###');
                $('#isiDataJemaat').html(arr_data[0]);
                $('#nav-output').html(arr_data[1]);
            }
        });
    }
    function tambahDataJemaatModal(){
        document.getElementById('cmd').value = "add";
        $('#viewDataJemaatModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> Tambah Data Jemaat');
        $('#tampilDataJemaatModal').attr('action','<?= '/adm/dataJemaat/createDataJemaat' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Data');
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showDataJemaat') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalDataJemaat').html(data);
            }
        });
    }
    function editDataJemaatModel(congregation_id){
        document.getElementById('cmd').value = "edit";
        $('#viewDataJemaatModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Edit Perjamuan Kudus');
        $('#tampilDataJemaatModal').attr('action','<?= '/adm/dataJemaat/updateDataJemaat' ?>');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Data');
        $.ajax({
            url : '<?= url('/adm/dataJemaat/showDataJemaat') ?>',
            data : {cmd : $('#cmd').val(), congregation_id : congregation_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiModalDataJemaat').html(data);
            }
        });
    }
    function deteleDataJemaat(congregation_id){
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
                    url : '<?= url('/adm/dataJemaat/deleteDataJemaat') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {congregation_id : congregation_id},
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
                        getDataJemaat();
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
    function downloadDataJemaat(){
        location.href="<?= asset('/downloadDataJemaat') ?>";
    }
</script>
@endpush