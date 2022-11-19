@extends('Layouts.frontend',['title' => 'Kesaksian'])
@section('content')
<div class="col-lg-12" id="cover-kesaksian" style="background: url('{{ asset('img/Kesaksian.png') }}');height: 100%;background-position: center ;background-repeat: no-repeat;background-size: cover;position: relative;">
    
</div>
<div class="col-lg-12" style="background-image: url('{{ asset('img/background-gereja.webp') }}');background-size:cover;background-position:center;background-repeat:no-repeat;position:relative">
    <div class="color-overlay"></div>
    <div class="row">
        <div class="col-lg-12 services-wrapper">
            <div class="services-wrapper" id="kesaksian">
                <div class="text-center py-5"><h2><strong> Kesaksian </strong></h2></div>
                <div class="container">
                    <?php 
                        if(count($dataKesaksian) == 0){
                            echo "
                                <div class='row px-3 py-3'>
                                    <div class='col-lg-12'>
                                        <center> <h3> TIDAK ADA DATA </h3> </center>
                                    </div>
                                </div>
                            ";
                        }else{
                        ?>
                            @foreach($dataKesaksian as $dK)
                                <div class="row px-3 py-3">
                                    <div class="col-lg-3 pt-5">
                                        <font> <center> <b> {{$dK->name}} </b> </center> </font><hr class="style-eight">
                                    </div>
                                    <div class="col-lg-9">
                                        <?= $dK->message ?>
                                    </div>
                                </div>
                            @endforeach
                        <?php    
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12 footer-wrapper">
            <div class="container">
                <div class="row px-3">
                    <div class="col-lg-12 bible-verse">
                        Janganlah kita menjauhkan diri dari pertemuan-pertemuan ibadah kita seperti dibiasakan beberapa orang tetapi marilah kita saling menashiati dan semakin giat melakukannya menjelang hari tuhan yang mendekat. <br>
                        - Ibrani 10:25 - 
                    </div>
                    <div class="col-lg-12 copyright">
                        2022 OLEH GEREJA MASEHI DI HALMAHERA UTARA <br>
                        &copy; ALL RIGHTS RESERVED
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function goToIbadah(){
        location.href="<?= url('/jadwalIbadah') ?>";
    }
    function goToKesaksian(){
        location.href="<?= url('/kesaksian') ?>";
    }
    function goToRenungan(){
        location.href="<?= url('/renungan') ?>";
    }
    function gotoToEvent(){
        location.href="<?= url('/event') ?>";
    }
    $('document').ready(function(){
        var data = "<?= $data ?>";
        $('#fontKesaksian').css('color','black');
        $('#fontKesaksian').wrapInner('<b></b>');
        $('#fontKesaksian').css({'-webkit-text-stroke':'0.5px white'});
        $('#fontBerita').css('color','gray');
        $('#fontTentangKami').css('color','gray');
        $('#fontBerita').css('cursor','not-allowed');
        $('#fontTentangKami').css('cursor','not-allowed');
    });
    window.onscroll = function() {myFunction()};
    var navbar = document.getElementById("navbar");
    var fontHome = document.getElementById('fontHome');
    var fontIbadah = document.getElementById('fontIbadah');
    var fontBerita = document.getElementById('fontBerita');
    var fontTentangKami = document.getElementById('fontTentangKami');
    var fontEvent = document.getElementById('fontEvent');
    var fontKesaksian = document.getElementById('fontKesaksian');
    var fontRenungan = document.getElementById('fontRenungan');
    var sticky = navbar.offsetTop;
    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
            if(window.pageYOffset >= 660){
                fontHome.classList.add("fontHome");
                fontIbadah.classList.add("fontIbadah");
                fontRenungan.classList.add("fontRenungan");
                fontEvent.classList.add("fontEvent");
                navbar.classList.add("navColor");
                $('#fontKesaksian').css({'-webkit-text-stroke':'1px black'});
                $('#fontKesaksian').css('color','white');
            }else{
                fontHome.classList.remove("fontHome");
                fontIbadah.classList.remove("fontIbadah");
                fontRenungan.classList.remove("fontRenungan");
                fontEvent.classList.remove("fontEvent");
                navbar.classList.remove("navColor");
                $('#fontKesaksian').css('color','black');
                $('#fontKesaksian').wrapInner('<b></b>');
                $('#fontKesaksian').css({'-webkit-text-stroke':'0.5px white'});
            }
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>
@endpush