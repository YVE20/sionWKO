@extends('Layouts.frontend',['title' => 'Home'])
@section('content')
<div class="col-lg-12" style="background-image: url('{{ asset('img/background-gereja.webp') }}');background-size:cover;background-position:center;background-repeat:no-repeat;position:relative">
    <div class="color-overlay"></div>
    <div class="row mt-5">
        <div class="col-lg-12 services-wrapper mt-5">
            <div class="services-wrapper" id="ibadahRemaja">
                <div class="text-center py-5"><h3><strong>  Event Gereja Sion WKO  </strong></h3></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach($eventModelGanjil as $eMGanjil)
                                @php $split = explode(':',$eMGanjil->time)  @endphp
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            @if($eMGanjil->photo == "")
                                                <img src="<?= asset('/uploads/NOPICTURE/no_picture.png') ?>" class="m-3" style="width:300px;height:500px; class="mt-3">
                                            @else
                                                <img src="<?= asset('/uploads/EVENT/'.$eMGanjil->photo) ?>" class="m-3" style="width:300px;height:500px;" class="mt-3">
                                            @endif
                                        </div>
                                        <div class="col-lg-6 p-3">
                                            <center> 
                                                <h3> {{strtoupper($eMGanjil->theme)}} </h3> 
                                                <h5> {{$eMGanjil->event}} </h5>
                                            </center><br><br>
                                            <table>
                                                <tr>
                                                    <td> Tempat </td>
                                                    <td> : {{$eMGanjil->place}} </td>
                                                </tr>
                                                <tr>
                                                    <td> Alamat </td>
                                                    <td> : {{$eMGanjil->address}} </td>
                                                </tr>
                                                <tr>
                                                    <td> Pukul </td>
                                                    <td> : {{$split[0].'.'.$split[1]}} WIT  </td>
                                                </tr>
                                            </table>
                                            <div class="mt-5" style="text-align: justify">
                                                <font style="font-weight:bold;"> MC : {{strtoupper($eMGanjil->speaker)}} </font><br>
                                                <font style="font-weight:bold;"> Narahubung : {{strtoupper($eMGanjil->contact_person)}} </font><br><br><br>
                                                <font> Ibrani 10 : 24 - 25 </font><br>
                                                <font> <i>  Dan marilah kita saling memperhatikan supaya kita saling mendorong dalam kasih dan dalam pekerjaan baik. Janganlah kita menjauhkan diri dari pertemuan-pertemuan ibadah kita, seperti dibiasakan oleh beberapa orang, tetapi marilah kita saling menasihati, dan semakin giat melakukannya menjelang hari Tuhan yang mendekat.</i> </font>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">

                                    </div>
                                </div>                  
                            @endforeach
                        </div>
                        <div class="col-lg-12 mt-3">
                            @foreach($eventModelGenap as $eMGenap)
                                @php $split = explode(':',$eMGenap->time)  @endphp
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-2">
                                        </div>
                                        <div class="col-lg-6 p-3">
                                            <center> 
                                                <h3> {{strtoupper($eMGenap->theme)}} </h3> 
                                                <h5> {{$eMGenap->event}} </h5>
                                            </center><br><br>
                                            <table>
                                                <tr>
                                                    <td> Tempat </td>
                                                    <td> : {{$eMGenap->place}} </td>
                                                </tr>
                                                <tr>
                                                    <td> Alamat </td>
                                                    <td> : {{$eMGenap->address}} </td>
                                                </tr>
                                                <tr>
                                                    <td> Pukul </td>
                                                    <td> : {{$split[0].'.'.$split[1]}} WIT  </td>
                                                </tr>
                                            </table>
                                            <div class="mt-5" style="text-align: justify">
                                                <font style="font-weight:bold;"> MC : {{strtoupper($eMGenap->speaker)}} </font><br>
                                                <font style="font-weight:bold;"> Narahubung : {{strtoupper($eMGenap->contact_person)}} </font><br><br><br>
                                                <font> Ibrani 10 : 24 - 25 </font><br>
                                                <font> <i>  Dan marilah kita saling memperhatikan supaya kita saling mendorong dalam kasih dan dalam pekerjaan baik. Janganlah kita menjauhkan diri dari pertemuan-pertemuan ibadah kita, seperti dibiasakan oleh beberapa orang, tetapi marilah kita saling menasihati, dan semakin giat melakukannya menjelang hari Tuhan yang mendekat.</i> </font>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            @if($eMGenap->photo == "")
                                                <img src="<?= asset('/uploads/NOPICTURE/no_picture.png') ?>" class="m-3" style="width:300px;height:500px; class="mt-3">
                                            @else
                                                <img src="<?= asset('/uploads/EVENT/'.$eMGenap->photo) ?>" class="m-3" style="width:300px;height:500px;" class="mt-3">
                                            @endif
                                        </div>
                                    </div>
                                </div>         
                            @endforeach
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 footer-wrapper mt-5">
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
            if(window.pageYOffset >= 660){
                fontHome.classList.add("fontHome");
                fontIbadah.classList.add("fontIbadah");
                fontRenungan.classList.add("fontRenungan");
                navbar.classList.add("navColor");
                $('#fontEvent').css({'-webkit-text-stroke':'1px black'});
                $('#fontEvent').css('color','white');
            }else{
                fontHome.classList.remove("fontHome");
                fontIbadah.classList.remove("fontIbadah");
                fontRenungan.classList.remove("fontRenungan");
                navbar.classList.remove("navColor");
                $('#fontEvent').css('color','black');
                $('#fontEvent').wrapInner('<b></b>');
                $('#fontEvent').css({'-webkit-text-stroke':'0.5px white'});
            }
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>
@endpush