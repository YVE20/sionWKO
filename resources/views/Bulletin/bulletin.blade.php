@extends('layouts.app',['title' => 'Sion WKO| Bulletin'])
@section('content')
@include('Bulletin.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row"> 
                <div class="text-left float-left col-lg-12">
                    <i class="fas fa-file-alt h5"></i> <font style="font-weight:bold;font-size:20px;"> Bulletin Gereja Jemaat Sion WKO </font>
                    <a class="btn btn-primary float-right" href="javascript:void(0)" onclick="tambahBulletinCoverModal()"> <i class="fas fa-plus-circle"></i> Tambah Cover </a>
                    <a class="btn btn-secondary mr-3 float-right" href="javascript:void(0)" onclick="viewBulletinCoverModal()"> <i class="far fa-eye"></i> Lihat Cover </a>
                </div>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th> No </th>
                            <th> Bulan </th>
                            <th> Gereja </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody id="isiDataBulletin">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
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
        getDataBulletin();
    });
    function getDataBulletin(){
        const year = new Date();
        $.ajax({
            url : '<?= url('/adm/bulletin/getAllBulletin') ?>',
            method : 'POST',
            data : {tahun : year.getFullYear()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $('#isiDataBulletin').html(data);
            }
        });
    }
    function downloadBulletin(bulan){
        location.href="<?= url('/adm/bulletin/downloadBulletin') ?>"+"/"+bulan;
    }
    function tambahBulletinCoverModal() {
        document.getElementById('cmd').value = "add";
        $('#addBulletinCoverModal').modal('show');
        $('.modal-title').html('<i class="fas fa-plus-circle"></i> BUSI');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-plus-circle"></i> Tambah Cover');
        $('#tampilBulletinCoverModal').attr('action','<?= '/adm/bulletin/createBulletinCover'?> ');
        $.ajax({
            url : '<?= url('/adm/bulletin/showBulletinCoverModel') ?>',
            data : {cmd : $('#cmd').val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiBulletinCoverModal').html(data);
            }
        });
    }
    function viewBulletinCoverModal(){
        $('#viewBulletinCoverModal').modal('show');
        $('.modal-title').html('<i class="far fa-eye"></i> Bulletin Cover');
        $('.modal-footer button[type=submit]').html('<i class="far fa-eye"></i> View Cover');
        $('#tampilBulletinCoverModal').attr('action','<?= '/adm/bulletin/createBulletinCover'?> ');
        $.ajax({
            url : '<?= url('/adm/bulletin/getAllBulletinCover') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiDataBulletinCoverModal').html(data);
            }
        });
    }
    function editBulletinCoverModal(cover_id){
        document.getElementById('cmd').value = "edit";
        $('#viewBulletinCoverModal').modal('hide');
        $('#addBulletinCoverModal').modal('show');
        $('.modal-title').html('<i class="fas fa-pencil-alt"></i> Bulletin Cover');
        $('.modal-footer button[type=submit]').html('<i class="fas fa-pencil-alt"></i> Edit Cover');
        $('#tampilBulletinCoverModal').attr('action','<?= '/adm/bulletin/updateBulletinCover'?> ');
        $.ajax({
            url : '<?= url('/adm/bulletin/showBulletinCoverModel') ?>',
            data : {cmd : $('#cmd').val(), cover_id : cover_id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiBulletinCoverModal').html(data);
            }
        });
    }
    function deleteBulletinCover(cover_id){
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
                    url : '<?= url('/adm/bulletin/deleteBulletinCover') ?>',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data : {cover_id : cover_id},
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
                        viewBulletinCoverModal();
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