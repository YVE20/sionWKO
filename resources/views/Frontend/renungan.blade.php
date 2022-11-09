@extends('Layouts.frontend',['title' => 'Renungan'])
@section('content')
<div class="col-lg-12" id="cover-renungan" style="background: url('{{ asset('img/Renungan Harian.png') }}');height: 100%;background-position: center ;background-repeat: no-repeat;background-size: cover;position: relative;">   
</div>
<div class="col-lg-12" style="background-image: url('{{ asset('img/background-gereja.webp') }}');background-size:cover;background-position:center;background-repeat:no-repeat;position:relative">
    <div class="color-overlay"></div>
    <div class="row">
        <div class="col-lg-12 services-wrapper">
            <div class="services-wrapper" id="kesaksian">
                <div class="text-center py-4"><h2><strong> Renungan Harian </strong></h2></div>
                <div class="container">
                    @if(count($dataRenungan) == 0)
                        <div class="row card-body">
                            <div class="col-lg-12 mt-2 shadow p-5">
                                <center> <h3> TIDAK ADA DATA </h3> </center>
                            </div>
                        </div>
                    @else
                        <div class="row card-body">
                            @foreach($dataRenungan as $dR)
                                <?php 
                                $split = explode(' ',$dR->created_at);
                                $splitTgl = explode('-',$split[0]); 
                                ?>
                                <div class="col-lg-4 mt-2" style="cursor: pointer;" onclick="openRenunganModal('<?= $dR->reflection_id ?>')">
                                    <div class="p-3 card shadow" style="height: 200px;border-radius: 10px;">
                                        <div>
                                            <b> Refleksi <?= $dR->bible_verse ?> </b> <br>
                                            <div class="cut-text">
                                                <font> <?= $dR->verse ?> </font>
                                            </div>
                                        </div><hr>
                                        <div class="cut-text" style="font-size:13px;margin-top:-10px">
                                            <font> SANTAPAN ROHANI. <?= $splitTgl[2]."-".$splitTgl[1]."-".$splitTgl[0] ?> </font><br>    
                                            <?= $dR->contents ?>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
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
<!-- Modal -->
<div class="modal fade" style="z-index:9999" id="renunganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body" id="isiRenungan">
                
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
    function gotoToEvent(){
        location.href="<?= url('/event') ?>";
    }
    function openRenunganModal(reflection_id){
        $('#renunganModal').modal('show');
        $.ajax({
            url : '<?= url('/getRenunganById') ?>',
            method : 'POST',
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {reflection_id : reflection_id},
            success:function(data){
                $('#isiRenungan').html(data);
            }
        });
    }
    $('document').ready(function(){
        $('#fontRenungan').css('color','black');
        $('#fontRenungan').wrapInner('<b></b>');
        $('#fontRenungan').css({'-webkit-text-stroke':'0.5px white'});
        $('#fontBerita').css('color','gray');
        $('#fontTentangKami').css('color','gray');
        $('#fontEvent').css('color','gray');
        $('#fontBerita').css('cursor','not-allowed');
        $('#fontTentangKami').css('cursor','not-allowed');
        $('#fontEvent').css('cursor','not-allowed');
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
                fontKesaksian.classList.add("fontKesaksian");
                navbar.classList.add("navColor");
                $('#fontRenungan').css({'-webkit-text-stroke':'1px black'});
                $('#fontRenungan').css('color','white');
            }else{
                fontHome.classList.remove("fontHome");
                fontIbadah.classList.remove("fontIbadah");
                fontKesaksian.classList.remove("fontKesaksian");
                navbar.classList.remove("navColor");
                $('#fontRenungan').css('color','black');
                $('#fontRenungan').wrapInner('<b></b>');
                $('#fontRenungan').css({'-webkit-text-stroke':'0.5px white'});
            }
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>
@endpush