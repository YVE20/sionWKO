@extends('Layouts.frontend',['title' => 'Ibadah'])
@section('content')
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<div class="col-lg-12 hero-image" id="rumah">
    
</div>
<div class="col-lg-12" style="background-image: url('{{ asset('img/background-gereja.webp') }}');background-size:cover;background-position:center;background-repeat:no-repeat;position:relative">
    <div class="color-overlay"></div>
    <div class="row">
        <div class="col-lg-12 services-wrapper">
            <div class="services-wrapper" id="ibadahRemaja">
                <div class="text-center py-5" onclick="viewIbadahRemaja()"><h3><strong> Ibadah Remaja <?= $bulan ?> </strong></h3></div>
                <div class="container">
                    <div class="row" id="viewIbadahRemaja" style="display:none">
                        <div class="col-lg-6" style="font-size:14px;">
                            <img src="{{asset('/img/Ibadah Remaja Sion.jpg')}}" alt="Remaja" style="height:300px;width:100%">
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:right"> 12.30 WIT </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahRemaja) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahRemaja as $dIR){
                                            $split = explode(' ',$dIR->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIR->place."</td>
                                                    <td>".$dIR->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper" id="ibadahPemuda">
                <div class="text-center py-5" onclick="viewIbadahPemuda()"><h3><strong> Ibadah Pemuda <?= $bulan ?> </strong></h3></div>
                <div class="container">
                    <div class="row" id="viewIbadahPemuda" style="display:none";>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:right"> 11.00 WIT </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahPemuda) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahPemuda as $dIP){
                                            $split = explode(' ',$dIP->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIP->place."</td>
                                                    <td>".$dIP->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <img src="{{asset('/img/Ibadah Pemuda Sion.jpg')}}" alt="Pemuda" style="height:300px;width:100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper" id="ibadahLingkunganPelayanan">
                <div class="text-center py-5" onclick="viewIbadahLingkunganPelayanan()"><h3><strong> Ibadah Lingkungan Pelayanan <?= $bulan ?> </strong></h3></div>
                <div class="container" id="viewIbadahLingkunganPelayanan" style="display:none;">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="{{asset('/img/Ibadah Lingkungan Pelayanan Sion.jpg')}}" alt="LingPel" style="height:300px;width:100%">
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 1 </font>
				            <font style="float:right"> Pukul 17.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan1) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan1 as $dIL1){
                                            $split = explode(' ',$dIL1->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL1->place."</td>
                                                    <td>".$dIL1->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 2 </font>
				            <font style="float:right"> Pukul 17.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan2) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan2 as $dIL2){
                                            $split = explode(' ',$dIL2->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL2->place."</td>
                                                    <td>".$dIL2->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 3 </font>
				            <font style="float:right"> Pukul 17.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan3) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan3 as $dIL3){
                                            $split = explode(' ',$dIL3->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL3->place."</td>
                                                    <td>".$dIL3->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 4 </font>
				            <font style="float:right"> Pukul 17.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan4) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan4 as $dIL4){
                                            $split = explode(' ',$dIL4->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL4->place."</td>
                                                    <td>".$dIL4->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 5 </font>
				            <font style="float:right"> Pukul 17.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan5) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan5 as $dIL5){
                                            $split = explode(' ',$dIL5->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL5->place."</td>
                                                    <td>".$dIL5->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper" id="ibadahKaumBapak">
                <div class="text-center py-5" onclick="viewIbadahKaumBapak()"><h3><strong> Ibadah Kaum Bapak <?= $bulan ?> </strong></h3></div>
                <div class="container" id="viewIbadahKaumBapak" style="display:none;">
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 1 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan1KaumBapak) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan1KaumBapak as $dIL1KB){
                                            $split = explode(' ',$dIL1KB->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL1KB->place."</td>
                                                    <td>".$dIL1KB->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <img src="{{asset('/img/Ibadah Kaum Bapak Sion.jpg')}}" alt="KaumBapak" style="height:300px;width:100%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 2 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan2KaumBapak) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan2KaumBapak as $dIL2KB){
                                            $split = explode(' ',$dIL2KB->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL2KB->place."</td>
                                                    <td>".$dIL2KB->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 3 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan3KaumBapak) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan3KaumBapak as $dIL3KB){
                                            $split = explode(' ',$dIL3KB->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL3KB->place."</td>
                                                    <td>".$dIL3KB->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-lg-6" style="font-size:13px;">
                            <font style="float:left"> Ibadah Lingkungan 4 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan4KaumBapak) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan4KaumBapak as $dIL4KB){
                                            $split = explode(' ',$dIL4KB->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL4KB->place."</td>
                                                    <td>".$dIL4KB->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 5 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan5KaumBapak) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan5KaumBapak as $dIL5KB){
                                            $split = explode(' ',$dIL5KB->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL5KB->place."</td>
                                                    <td>".$dIL5KB->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper" id="ibadahKaumIbu">
                <div class="text-center py-5" onclick="viewIbadahKaumIbu()"><h3><strong> Ibadah Kaum Ibu <?= $bulan ?> </strong></h3></div>
                <div class="container" id="viewIbadahKaumIbu" style="display:none;">
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <img src="{{asset('/img/Ibadah Kaum Ibu Sion.jpg')}}" alt="KaumBapak" style="height:300px;width:100%">
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 1 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan1KaumIbu) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan1KaumIbu as $dIL1KI){
                                            $split = explode(' ',$dIL1KI->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL1KI->place."</td>
                                                    <td>".$dIL1KI->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 2 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan2KaumIbu) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan2KaumIbu as $dIL2KI){
                                            $split = explode(' ',$dIL2KI->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL2KI->place."</td>
                                                    <td>".$dIL2KI->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 3 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan3KaumIbu) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan3KaumIbu as $dIL3KI){
                                            $split = explode(' ',$dIL3KI->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL3KI->place."</td>
                                                    <td>".$dIL3KI->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 4 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan4KaumIbu) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan4KaumIbu as $dIL4KI){
                                            $split = explode(' ',$dIL4KI->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL4KI->place."</td>
                                                    <td>".$dIL4KI->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 5 </font>
				            <font style="float:right"> Pukul 11.00 WIT </font><br><br>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan5KaumIbu) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan5KaumIbu as $dIL5KI){
                                            $split = explode(' ',$dIL5KI->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL5KI->place."</td>
                                                    <td>".$dIL5KI->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper" id="ibadahKaumGembira">
                <div class="text-center py-5" onclick="viewIbadahMingguGembira()"><h3><strong> Ibadah Minggu Gembira <?= $bulan ?> </strong></h3></div>
                <div class="container" id="viewIbadahMingguGembira" style="display:none;">
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 1 </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan1MingguGembira) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan1MingguGembira as $dIL1MG){
                                            $split = explode(' ',$dIL1MG->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL1MG->place."</td>
                                                    <td>".$dIL1MG->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <img src="{{asset('/img/Ibadah Minggu Gembira Sion.jpg')}}" alt="MingguGembira" style="height:300px;width:100%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 2 </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan2MingguGembira) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan2MingguGembira as $dIL2MG){
                                            $split = explode(' ',$dIL2MG->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL2MG->place."</td>
                                                    <td>".$dIL2MG->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 3 </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan3MingguGembira) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan3MingguGembira as $dIL3MG){
                                            $split = explode(' ',$dIL3MG->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL3MG->place."</td>
                                                    <td>".$dIL3MG->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 4 </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan4MingguGembira) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan4MingguGembira as $dIL4MG){
                                            $split = explode(' ',$dIL4MG->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL4MG->place."</td>
                                                    <td>".$dIL4MG->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:left"> Ibadah Lingkungan 5 </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLingkungan5MingguGembira) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLingkungan5MingguGembira as $dIL5MG){
                                            $split = explode(' ',$dIL5MG->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIL5MG->place."</td>
                                                    <td>".$dIL5MG->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper" id="ibadahAnakSekolahMinggu">
                <div class="text-center py-5" onclick="viewIbadahAnakSekolahMinggu()"><h3><strong> Ibadah Anak Sekolah Minggu <?= $bulan ?> </strong></h3></div>
                <div class="container" id="viewIbadahAnakSekolahMinggu" style="display:none">
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:right"> 07.00 WIT </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahSekolahMingguJam7) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahSekolahMingguJam7 as $dISMJ7){
                                            $split = explode(' ',$dISMJ7->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dISMJ7->place."</td>
                                                    <td>".$dISMJ7->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <img src="{{asset('/img/Ibadah Anak Sekolah Minggu.jpg')}}" alt="AnakSekolahMinggu" style="height:300px;width:100%">
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper" id="ibadahlainlain">
                <div class="text-center py-5" onclick="viewIbadahLainlain()"><h3><strong> Ibadah Lain-lain <?= $bulan ?> </strong></h3></div>
                <div class="container" id="viewIbadahLainlain" style="display:none">
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:right;font-weight:bold"> {{strtoupper("Ibadah Keluarga Pelayan (19.30 WIT)")}} </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLainlainKeluargaPelayan) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLainlainKeluargaPelayan as $dILlKP){
                                            $split = explode(' ',$dILlKP->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            $timestamp = strtotime($split[0]);
                                            $day = date('l',$timestamp);

                                            $hari = "";                                            
                                            if($day == "Sunday"){
                                                $hari = "Minggu";
                                            }else if($day == "Monday"){
                                                $hari = "Senin";
                                            }else if($day == "Tuesday"){
                                                $hari = "Selasa";
                                            }else if($day == "Wednesday"){
                                                $hari = "Rabu";
                                            }else if($day == "Thursday"){
                                                $hari = "Kamis";
                                            }else if($day == "Friday"){
                                                $hari = "Jumat";
                                            }else if($day == "Saturday"){
                                                $hari = "Sabtu";
                                            }

                                            echo "
                                                <tr>
                                                    <td>".$hari.", ".$newDate[2]."</td>
                                                    <td>".$dILlKP->place."</td>
                                                    <td>".$dILlKP->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:right;font-weight:bold"> {{strtoupper("Ibadah Pelajar (16.00 WIT)")}} </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLainlainPelajar) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLainlainPelajar as $dILlP){
                                            $split = explode(' ',$dILlP->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            $timestamp = strtotime($split[0]);
                                            $day = date('l',$timestamp);

                                            $hari = "";                                            
                                            if($day == "Sunday"){
                                                $hari = "Minggu";
                                            }else if($day == "Monday"){
                                                $hari = "Senin";
                                            }else if($day == "Tuesday"){
                                                $hari = "Selasa";
                                            }else if($day == "Wednesday"){
                                                $hari = "Rabu";
                                            }else if($day == "Thursday"){
                                                $hari = "Kamis";
                                            }else if($day == "Friday"){
                                                $hari = "Jumat";
                                            }else if($day == "Saturday"){
                                                $hari = "Sabtu";
                                            }
                                            echo "
                                                <tr>
                                                    <td>".$hari.", ".$newDate[2]."</td>
                                                    <td>".$dILlP->place."</td>
                                                    <td>".$dILlP->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:right;font-weight:bold"> {{strtoupper("Ibadah Usinda (16.00 WIT)")}} </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLainlainUsinda) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLainlainUsinda as $dILlU){
                                            $split = explode(' ',$dILlU->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            $timestamp = strtotime($split[0]);
                                            $day = date('l',$timestamp);

                                            $hari = "";                                            
                                            if($day == "Sunday"){
                                                $hari = "Minggu";
                                            }else if($day == "Monday"){
                                                $hari = "Senin";
                                            }else if($day == "Tuesday"){
                                                $hari = "Selasa";
                                            }else if($day == "Wednesday"){
                                                $hari = "Rabu";
                                            }else if($day == "Thursday"){
                                                $hari = "Kamis";
                                            }else if($day == "Friday"){
                                                $hari = "Jumat";
                                            }else if($day == "Saturday"){
                                                $hari = "Sabtu";
                                            }
                                            echo "
                                                <tr>
                                                    <td>".$hari.", ".$newDate[2]."</td>
                                                    <td>".$dILlU->place."</td>
                                                    <td>".$dILlU->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:right;font-weight:bold"> {{strtoupper("Ibadah Pergumulan MJ (22.00 WIT)")}} </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahLainlainPergumulanMJ) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahLainlainPergumulanMJ as $dILlPMJ){
                                            $split = explode(' ',$dILlPMJ->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            $timestamp = strtotime($split[0]);
                                            $day = date('l',$timestamp);

                                            $hari = "";                                            
                                            if($day == "Sunday"){
                                                $hari = "Minggu";
                                            }else if($day == "Monday"){
                                                $hari = "Senin";
                                            }else if($day == "Tuesday"){
                                                $hari = "Selasa";
                                            }else if($day == "Wednesday"){
                                                $hari = "Rabu";
                                            }else if($day == "Thursday"){
                                                $hari = "Kamis";
                                            }else if($day == "Friday"){
                                                $hari = "Jumat";
                                            }else if($day == "Saturday"){
                                                $hari = "Sabtu";
                                            }
                                            echo "
                                                <tr>
                                                    <td>".$hari.", ".$newDate[2]."</td>
                                                    <td>".$dILlPMJ->place."</td>
                                                    <td>".$dILlPMJ->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-wrapper" id="ibadahlainlain">
                <div class="text-center py-5" onclick="viewIbadahMinggu()"><h3><strong> Ibadah Minggu <?= $bulan ?> </strong></h3></div>
                <div class="container" id="viewIbadahMinggu" style="display:none">
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:right"> 07.00 WIT </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahMingguJam7) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahMingguJam7 as $dIMJ7){
                                            $split = explode(' ',$dIMJ7->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIMJ7->place."</td>
                                                    <td>".$dIMJ7->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <img src="{{asset('/img/Ibadah Minggu - 7.jpg')}}" alt="MingguGembira" style="height:300px;width:100%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" style="font-size:14px;">
                            <img src="{{asset('/img/Ibadah Minggu - 9.jpg')}}" alt="MingguGembira" style="height:300px;width:100%">
                        </div>
                        <div class="col-lg-6" style="font-size:14px;">
                            <font style="float:right"> 09.30 WIT </font>
                            <table class="table" style="margin-top:-15px;">
                                <thead>
                                    <tr>
                                        <th> Hari, tgl </th>
                                        <th> Tempat Ibadah </th>
                                        <th> Pelayan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dataIbadahMingguJam9) == "0")
                                        <tr>
                                            <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                                        </tr>
                                    @else
                                    <?php 
                                        foreach($dataIbadahMingguJam9 as $dIMJ9){
                                            $split = explode(' ',$dIMJ9->sermon_date);
                                            $newDate = explode('-',$split[0]);
                                            echo "
                                                <tr>
                                                    <td> Minggu, ".$newDate[2]."</td>
                                                    <td>".$dIMJ9->place."</td>
                                                    <td>".$dIMJ9->speaker."</td>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    @endif
                                </tbody>
                            </table>
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
    function viewIbadahRemaja(){
        $('#viewIbadahRemaja').slideToggle('slow');
    }
    function viewIbadahPemuda(){
        $('#viewIbadahPemuda').slideToggle('slow');
    }
    function viewIbadahLingkunganPelayanan(){
        $('#viewIbadahLingkunganPelayanan').slideToggle('slow');
    }
    function viewIbadahKaumBapak(){
        $('#viewIbadahKaumBapak').slideToggle('slow');
    }
    function viewIbadahKaumIbu(){
        $('#viewIbadahKaumIbu').slideToggle('slow');
    }
    function viewIbadahMingguGembira(){
        $('#viewIbadahMingguGembira').slideToggle('slow');
    }
    function viewIbadahAnakSekolahMinggu(){
        $('#viewIbadahAnakSekolahMinggu').slideToggle('slow');
    }
    function viewIbadahLainlain(){
        $('#viewIbadahLainlain').slideToggle('slow');
    }
    function viewIbadahMinggu(){
        $('#viewIbadahMinggu').slideToggle('slow');
    }
    $('document').ready(function(){
        $('#fontIbadah').css('color','black');
        $('#fontIbadah').wrapInner('<b></b>');
        $('#fontIbadah').css({'-webkit-text-stroke':'0.5px white'});
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
                fontRenungan.classList.add("fontRenungan");
                fontKesaksian.classList.add("fontKesaksian");
                fontEvent.classList.add("fontEvent");
                navbar.classList.add("navColor");
                $('#fontIbadah').css({'-webkit-text-stroke':'1px black'});
                $('#fontIbadah').css('color','white');
            }else{
                fontHome.classList.remove("fontHome");
                fontRenungan.classList.remove("fontRenungan");
                fontKesaksian.classList.remove("fontKesaksian");
                fontEvent.classList.remove("fontEvent");
                navbar.classList.remove("navColor");
                $('#fontIbadah').css('color','black');
                $('#fontIbadah').wrapInner('<b></b>');
                $('#fontIbadah').css({'-webkit-text-stroke':'0.5px white'});
            }
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>
@endpush