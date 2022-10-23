<<<<<<< HEAD
@extends('layouts.frontend',['title' => 'Kesaksian'])
=======
@extends('Layouts.frontend',['title' => 'Kesaksian'])
>>>>>>> e31524c9c0cb566971c2c2d7d469a6cb9f1aac23
@section('content')
<div class="col-lg-12 hero-image" id="rumah">
    
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
                                        <font> <center> <b> {{$dK->name}} </b> </center> </font><hr>
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

@endpush