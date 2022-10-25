@extends('Layouts.frontend',['title' => 'Renungan'])
@section('content')
<div class="col-lg-12" id="cover-renungan" style="background: url('{{ asset('img/Renungan.jpg') }}');height: 100%;background-position: center ;background-repeat: no-repeat;background-size: cover;position: relative;">   
</div>
<div class="col-lg-12" style="background-image: url('{{ asset('img/background-gereja.webp') }}');background-size:cover;background-position:center;background-repeat:no-repeat;position:relative">
    <div class="color-overlay"></div>
    <div class="row">
        <div class="col-lg-12 services-wrapper">
            <div class="services-wrapper" id="kesaksian">
                <div class="text-center py-4"><h2><strong> Renungan Harian </strong></h2></div>
                <div class="container">
                    <div class="row card-body">
                        <div class="col-lg-4 mt-2">
                            <div class="p-3 card shadow" style="height: 170px;">
                                <b> Refleksi Matius 5 14-16: Apakah Anda orang yang menjadi terang dan memuliakan Tuhan? </b> <br>
                                <div class="cut-text">
                                    Engkau adalah terang dunia. Sebuah kota yang dibangun di atas bukit tidak dapat disembunyikan. Orang tidak menyalakan pelita dan meletakkannya di bawah gantang. Sebaliknya mereka meletakkannya di atas kaki dian, dan itu menerangi semua orang di rumah. Demikian pula, biarlah terangmu bersinar di hadapan orang lain, agar mereka melihat perbuatan baikmu dan memuliakan Bapamu yang di surga.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <div class="p-3 card shadow" style="height: 170px;">
                                <b> Refleksi Matius 5 14-16: Apakah Anda orang yang menjadi terang dan memuliakan Tuhan? </b> <br>
                                <div class="cut-text">
                                    Engkau adalah terang dunia. Sebuah kota yang dibangun di atas bukit tidak dapat disembunyikan. Orang tidak menyalakan pelita dan meletakkannya di bawah gantang. Sebaliknya mereka meletakkannya di atas kaki dian, dan itu menerangi semua orang di rumah. Demikian pula, biarlah terangmu bersinar di hadapan orang lain, agar mereka melihat perbuatan baikmu dan memuliakan Bapamu yang di surga.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <div class="p-3 card shadow" style="height: 170px;">
                                <b> Refleksi Matius 5 14-16: Apakah Anda orang yang menjadi terang dan memuliakan Tuhan? </b> <br>
                                <div class="cut-text">
                                    Engkau adalah terang dunia. Sebuah kota yang dibangun di atas bukit tidak dapat disembunyikan. Orang tidak menyalakan pelita dan meletakkannya di bawah gantang. Sebaliknya mereka meletakkannya di atas kaki dian, dan itu menerangi semua orang di rumah. Demikian pula, biarlah terangmu bersinar di hadapan orang lain, agar mereka melihat perbuatan baikmu dan memuliakan Bapamu yang di surga.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-2">
                            <div class="p-3 card" style="height: 170px;">
                                <b> Refleksi Matius 5 14-16: Apakah Anda orang yang menjadi terang dan memuliakan Tuhan? </b> <br>
                                <div class="cut-text">
                                    Engkau adalah terang dunia. Sebuah kota yang dibangun di atas bukit tidak dapat disembunyikan. Orang tidak menyalakan pelita dan meletakkannya di bawah gantang. Sebaliknya mereka meletakkannya di atas kaki dian, dan itu menerangi semua orang di rumah. Demikian pula, biarlah terangmu bersinar di hadapan orang lain, agar mereka melihat perbuatan baikmu dan memuliakan Bapamu yang di surga.
                                </div>
                            </div>
                        </div>
                    </div>        
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
</script>
@endpush