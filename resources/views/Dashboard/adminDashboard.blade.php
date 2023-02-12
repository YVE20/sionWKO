@extends('Layouts.app',['title' => 'Sion WKO| Dashboard'])
@section('content')
@include('Dashboard.modal')
<div class="col-md-12 p-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5 p-2 m-2 float-left card">
                    <font> <center> <h5> <b> Renungan Harian </b> </h5> </center> </font> <hr>
                    <div id="isiRenungan"></div>
                </div>    
                <div class="col-lg-5 p-2 m-2 float-left card" style="text-align: justify">
                <font> <center> <h5> <b> Ayat Harian </b> </h5> </font> </center> <hr>
                    <div class="p-4">
                        <b><font style="font-size: 13px" id="AyatHarian"></font></b><br>
                        <i><font style="font-size: 13px" id="isiAyatHarian"></font></i>
                    </div>
                </div>            
            </div>
            <div class="row">
                <div class="col-lg-2 col-6 float-left" style="padding:10px;cursor:pointer;" onclick="dataJemaat()">
                    <acronym title="Data Jemaat">
                        <div class="col-lg-12 float-left" style="padding:0px;box-shadow: 3px 3px 5px 6px #ccc;">
                            <div style="height:100px;">
                                <div class="col-lg-6 col-5 pt-3 float-left">
                                    <i class="fas fa-users" style="font-size: 60px;opacity: 30%;"></i>
                                </div>
                                <div class="col-lg-6 col-7 float-left">
                                    <div class="float-left pt-4">
                                        <font class="float-left"> Data <br> Jemaat </font>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#F6F7F7;height:30px">
                                <center>
                                    Read More 
                                    <i class="fas fa-play-circle"></i>
                                </center>
                            </div>
                        </div>
                    </acronym>
                </div>
                <div class="col-lg-2 col-6 float-left" style="padding:10px;cursor:pointer;" onclick="eventGereja()">
                    <acronym title="Event Gereja">
                        <div class="col-lg-12 float-left" style="padding:0px;box-shadow: 3px 3px 5px 6px #ccc;">
                            <div style="background-color:#0cb95d;height:100px;">
                                <div class="col-lg-6 col-5 pt-3 float-left">
                                    <i class="fas fa-calendar-alt" style="font-size: 60px;opacity: 30%;"></i>
                                </div>
                                <div class="col-lg-6 col-7 float-left text-white">
                                    <div class="float-left pt-4">
                                        <font class="float-left"> Event <br> Gereja </font>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color: #0fa64d;height:30px;color:white;">
                                <center>
                                    Read More 
                                    <i class="fas fa-play-circle"></i>
                                </center>
                            </div>
                        </div>
                    </acronym>
                </div>
                <div class="col-lg-2 col-6 float-left" style="padding:10px;cursor:pointer;">
                    <acronym title="Ayat Harian">
                        <div class="col-lg-12 float-left" style="padding:0px;box-shadow: 3px 3px 5px 6px #ccc;">
                            <div style="background-color:#2f8aa7;height:100px;">
                                <div class="col-lg-6 col-5 pt-3 float-left">
                                    <i class="fas fa-bible" style="font-size: 60px;opacity: 30%;"></i>
                                </div>
                                <div class="col-lg-6 col-7 float-left text-white">
                                    <div class="float-left pt-4">
                                        <font class="float-left"> Ayat <br> Harian </font>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color: #246E85;height:30px;color:white;">
                                <center>
                                    Read More 
                                    <i class="fas fa-play-circle"></i>
                                </center>
                            </div>
                        </div>
                    </acronym>
                </div>
                <div class="col-lg-2 col-6 float-left" style="padding:10px;cursor:pointer">
                    <acronym title="Tentang Gereja">
                        <div class="col-lg-12 float-left" style="padding:0px;box-shadow: 3px 3px 5px 6px #ccc;">
                            <div style="background-color:#1c53a0;height:100px;">
                                <div class="col-lg-6 col-5 pt-3 float-left">
                                    <i class="fas fa-info-circle" style="font-size: 60px;opacity: 30%;"></i>
                                </div>
                                <div class="col-lg-6 col-7 float-left text-white">
                                    <div class="float-left pt-4">
                                        <font class="float-left"> Tentang <br> Gereja </font>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color: #143A6F;height:30px;color:white;">
                                <center>
                                    Read More 
                                    <i class="fas fa-play-circle"></i>
                                </center>
                            </div>
                        </div>
                    </acronym>
                </div>
                <div class="col-lg-2 col-6 float-left" style="padding:10px;cursor:pointer;" onclick="statistikJemaat()">
                    <acronym title="Event Gereja">
                        <div class="col-lg-12 float-left" style="padding:0px;box-shadow: 3px 3px 5px 6px #ccc;">
                            <div style="background-color:#0cb95d;height:100px;">
                                <div class="col-lg-6 col-5 pt-3 float-left">
                                    <i class="fas fa-chart-bar" style="font-size: 60px;opacity: 30%;"></i>
                                </div>
                                <div class="col-lg-6 col-7 float-left text-white">
                                    <div class="float-left pt-4">
                                        <font class="float-left"> Statistik <br> Jemaat </font>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color: #0fa64d;height:30px;color:white;">
                                <center>
                                    Read More 
                                    <i class="fas fa-play-circle"></i>
                                </center>
                            </div>
                        </div>
                    </acronym>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    ayatHarian();
    renunganHarian();
    function ayatHarian(){
        $.ajax({
            url : '<?= url('/loadAyatHarianDB') ?>',
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                var arr_data = data.split('###');
                $('#AyatHarian').html(arr_data[0]);
                $('#isiAyatHarian').html(arr_data[1]);
            }
        });
    }
    function renunganHarian(){
        const d = new Date();
        let date = d.getDate()
        $.ajax({
            url : '<?= url('/renunganHarianForToday') ?>',
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : { date : date },
            success:function(data){
                $('#isiRenungan').html(data);
            }
        });
    }
    function dataJemaat(){
        $('#dataJemaatModal').modal('show');
        $.ajax({
            url : '<?= url('/adm/dashboard/getDataJemaat') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiDataJemaat').html(data);
            }
        });
    }
    function eventGereja(){
        $('#eventGerejaModal').modal('show');
        $.ajax({
            url : '<?= url('/adm/dashboard/getEventGereja') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiEventGereja').html(data);
            }
        });
    }
    function statistikJemaat(){
        $('#statistikJemaatModal').modal('show');
        $.ajax({
            url : '<?= url('/adm/dashboard/getStatistikJemaat') ?>',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method : 'POST',
            success:function(data){
                $('#isiStatistikJemaat').html(data);
            }
        });
    }
</script>
@endpush