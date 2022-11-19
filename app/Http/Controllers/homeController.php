<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendEmailSionWKO;
use App\Models\ibadahModel;
use App\Models\kesaksianModel;
use App\Models\renunganModel;
use App\Models\dataJemaatModel;
use App\Models\dataSIDIModel;
use App\Models\kartuKeluargaModel;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\eventModel;
use App\Models\rapatEvaluasiModel;
use App\Models\pembagianMajelisModel;

class homeController extends Controller
{
    public function home(){
        $dataKesaksian = kesaksianModel::orderByRaw("SUBSTRING_INDEX(testimony_id, '/', -1) + 0 ASC")->get();
        $row = $dataKesaksian->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_Kesaksian = $dataKesaksian[$row-1]->testimony_id;
            $pisah = explode('/',$id_Kesaksian);
            $row = $pisah[3] + 1;
        }
        $date = date('m/Y');
        $split = explode('/', $date);
        $bulan = $split[0];
        $tahun = $split[1];

        $isAyatHarian = false;
        $dataRenungan = renunganModel::whereRaw('day(created_at) ='.date('d'))->whereRaw('month(created_at) ='.date('m'))->whereRaw('year(created_at) ='.date('Y'))->get();
        if(count($dataRenungan) != null){
            $isAyatHarian = true;
        }
        $data = [
            'id_kesaksian' => "KSK/".$bulan."/".$tahun."/".$row,
            'isAyatHarian' => $isAyatHarian,
            'data' => 'HOME'
        ];
        return view('Frontend.home',$data);
    }
    public function loadAyatHarianDB(){
        $isi = '';
        $dataRenungan = renunganModel::whereRaw('day(created_at) ='.date('d'))->whereRaw('month(created_at) ='.date('m'))->whereRaw('year(created_at) ='.date('Y'))->get();
        foreach($dataRenungan as $dR){
            $isi .=$dR->bible_verse;
            $isi .='###';
            $isi .=$dR->verse;
        }
        return $isi;
    }
    public function loadAyatHarianAPI(){
        $isi = '';
        $urlAyat = "https://indo-bible.herokuapp.com/bible/random";
        $curlAyat = curl_init($urlAyat);
        curl_setopt($curlAyat, CURLOPT_URL, $urlAyat);
        curl_setopt($curlAyat, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
            "Content-Length: 0",
        );
        curl_setopt($curlAyat, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curlAyat);
        $object = json_decode($response, TRUE);
        $isi .=$object['id']['verse']['details']['reference'];
        $isi .='###';
        $isi .=$object['id']['verse']['details']['text'];
        return $isi;
    }
    public function isiRenunganHarian(){
        dd(date("Y-m-d"));
        $dataRenungan = renunganModel::orderByRaw("SUBSTRING_INDEX(reflection_id, '/', -1) + 0 ASC")->get();
        $row = $dataRenungan->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_renungan = $dataRenungan[$row-1]->reflection_id;
            $pisah = explode('/',$id_renungan);
            $row = $pisah[3] + 1;
        }
        $date = date('m/Y');
        $split = explode('/', $date);
        $bulan = $split[0];
        $tahun = $split[1];


        renunganModel::create([
            'reflection_id' => "REN/".$bulan."/".$tahun."/".$row,
            'reflection_title' => $_POST['ayat'],
            'bible_verse' => $_POST['ayat'],
            'verse' => $_POST['isiAyat'],
            'contents' => "-"
        ]);
        return "success";
    }
    public function hubungiKami(Request $request){
        kesaksianModel::create([
            'testimony_id' => $request->testimony_id,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        return redirect('/')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
        /* Mail::to('test@gmail.com')->send(new sendEmailSionWKO($request->all()));
        return redirect('/')->with(["status"=>"Pesan berhasil dikirim", "judul_alert" => "Berhasil" , "icon" => "success"]); */
    }
    public function jadwalIbadah(){
        $dataIbadahLingkungan1 = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','1')->where('tb_ibadah.category_id','IBD/IBLP/2022')->get();
        $dataIbadahLingkungan2 = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','2')->where('tb_ibadah.category_id','IBD/IBLP/2022')->get();
        $dataIbadahLingkungan3 = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','3')->where('tb_ibadah.category_id','IBD/IBLP/2022')->get();
        $dataIbadahLingkungan4 = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','4')->where('tb_ibadah.category_id','IBD/IBLP/2022')->get();
        $dataIbadahLingkungan5 = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','5')->where('tb_ibadah.category_id','IBD/IBLP/2022')->get();

        //Data Ibadah Kategori Kaum Bapak
        $dataIbadahLingkungan1KaumBapak = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','1')->where('tb_ibadah.category_id','IBD/IBKB/2022')->get();
        $dataIbadahLingkungan2KaumBapak = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','2')->where('tb_ibadah.category_id','IBD/IBKB/2022')->get();
        $dataIbadahLingkungan3KaumBapak = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','3')->where('tb_ibadah.category_id','IBD/IBKB/2022')->get();
        $dataIbadahLingkungan4KaumBapak = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','4')->where('tb_ibadah.category_id','IBD/IBKB/2022')->get();
        $dataIbadahLingkungan5KaumBapak = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','5')->where('tb_ibadah.category_id','IBD/IBKB/2022')->get();

        //Data Ibadah Kategori Kaum Ibu
        $dataIbadahLingkungan1KaumIbu = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','1')->where('tb_ibadah.category_id','IBD/IBKI/2022')->get();
        $dataIbadahLingkungan2KaumIbu = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','2')->where('tb_ibadah.category_id','IBD/IBKI/2022')->get();
        $dataIbadahLingkungan3KaumIbu = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','3')->where('tb_ibadah.category_id','IBD/IBKI/2022')->get();
        $dataIbadahLingkungan4KaumIbu = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','4')->where('tb_ibadah.category_id','IBD/IBKI/2022')->get();
        $dataIbadahLingkungan5KaumIbu = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','5')->where('tb_ibadah.category_id','IBD/IBKI/2022')->get();

        //Data Ibadah Kategori Pemuda
        $dataIbadahPemuda = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBP/2022')->get();

        //Data Ibadah Kategori Remaja
        $dataIbadahRemaja = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBR/2022')->get();

        //Data Ibadah Kategori Minggu Gembira
        $dataIbadahLingkungan1MingguGembira = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','1')->where('tb_ibadah.category_id','IBD/IBMG/2022')->get();
        $dataIbadahLingkungan2MingguGembira = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','2')->where('tb_ibadah.category_id','IBD/IBMG/2022')->get();
        $dataIbadahLingkungan3MingguGembira = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','3')->where('tb_ibadah.category_id','IBD/IBMG/2022')->get();
        $dataIbadahLingkungan4MingguGembira = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','4')->where('tb_ibadah.category_id','IBD/IBMG/2022')->get();
        $dataIbadahLingkungan5MingguGembira = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.service_environtment','5')->where('tb_ibadah.category_id','IBD/IBMG/2022')->get();

        //Ibadah Sekolah Minggu
        $dataIbadahSekolahMingguJam7 = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBASM/2022')->whereRaw('time="07:00:00"')->get();
        $dataIbadahSekolahMingguJam9 = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBASM/2022')->whereRaw('time="09:30:00"')->get();

        //Ibadah Lain-lain
        $dataIbadahLainlainKeluargaPelayan = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBLL/2022')->where('worship','Ibadah Keluarga Pelayan')->get();
        $dataIbadahLainlainPelajar = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBLL/2022')->where('worship','Ibadah Pelajar')->get();
        $dataIbadahLainlainUsinda = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBLL/2022')->where('worship','Ibadah Usinda')->get();
        $dataIbadahLainlainPergumulanMJ = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBLL/2022')->where('worship','Ibadah Pergumulan MJ')->get();

        //Ibadah Minggu
        $dataIbadahMingguJam7 = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBM/2022')->whereRaw('time="07:00:00"')->get();
        $dataIbadahMingguJam9 = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->where('tb_ibadah.category_id','IBD/IBM/2022')->whereRaw('time="09:30:00"')->get();

        $bulan = date('m');
        $month = "";
        if($bulan == "1"){
            $month = "Januari";
        }else if($bulan == "2"){
            $month = "Februari";
        }else if($bulan == "3"){
            $month = "Maret";
        }else if($bulan == "4"){
            $month = "April";
        }else if($bulan == "5"){
            $month = "Mei";
        }else if($bulan == "6"){
            $month = "Juni";
        }else if($bulan == "7"){
            $month = "Juli";
        }else if($bulan == "8"){
            $month = "Agustus";
        }else if($bulan == "9"){
            $month = "September";
        }else if($bulan == "10"){
            $month = "Oktober";
        }else if($bulan == "11"){
            $month = "November";
        }else if($bulan == "12"){
            $month = "Desember";
        }else{
            $month = "--BULAN--";
        }

        $data = [
            'bulan' => $month,
            'dataIbadahLingkungan1' => $dataIbadahLingkungan1,
            'dataIbadahLingkungan2' => $dataIbadahLingkungan2,
            'dataIbadahLingkungan3' => $dataIbadahLingkungan3,
            'dataIbadahLingkungan4' => $dataIbadahLingkungan4,
            'dataIbadahLingkungan5' => $dataIbadahLingkungan5,
            'dataIbadahLingkungan1KaumBapak' => $dataIbadahLingkungan1KaumBapak,
            'dataIbadahLingkungan2KaumBapak' => $dataIbadahLingkungan2KaumBapak,
            'dataIbadahLingkungan3KaumBapak' => $dataIbadahLingkungan3KaumBapak,
            'dataIbadahLingkungan4KaumBapak' => $dataIbadahLingkungan4KaumBapak,
            'dataIbadahLingkungan5KaumBapak' => $dataIbadahLingkungan5KaumBapak,
            'dataIbadahLingkungan1KaumIbu' => $dataIbadahLingkungan1KaumIbu,
            'dataIbadahLingkungan2KaumIbu' => $dataIbadahLingkungan2KaumIbu,
            'dataIbadahLingkungan3KaumIbu' => $dataIbadahLingkungan3KaumIbu,
            'dataIbadahLingkungan4KaumIbu' => $dataIbadahLingkungan4KaumIbu,
            'dataIbadahLingkungan5KaumIbu' => $dataIbadahLingkungan5KaumIbu,
            'dataIbadahPemuda' => $dataIbadahPemuda,
            'dataIbadahRemaja' => $dataIbadahRemaja,
            'dataIbadahLingkungan1MingguGembira' => $dataIbadahLingkungan1MingguGembira,
            'dataIbadahLingkungan2MingguGembira' => $dataIbadahLingkungan2MingguGembira,
            'dataIbadahLingkungan3MingguGembira' => $dataIbadahLingkungan3MingguGembira,
            'dataIbadahLingkungan4MingguGembira' => $dataIbadahLingkungan4MingguGembira,
            'dataIbadahLingkungan5MingguGembira' => $dataIbadahLingkungan5MingguGembira,
            'dataIbadahSekolahMingguJam7' => $dataIbadahSekolahMingguJam7,
            'dataIbadahSekolahMingguJam9' => $dataIbadahSekolahMingguJam9,
            'dataIbadahLainlainKeluargaPelayan' => $dataIbadahLainlainKeluargaPelayan,
            'dataIbadahLainlainPelajar' => $dataIbadahLainlainPelajar,
            'dataIbadahLainlainUsinda' => $dataIbadahLainlainUsinda,
            'dataIbadahLainlainPergumulanMJ' => $dataIbadahLainlainPergumulanMJ,
            'dataIbadahMingguJam7' => $dataIbadahMingguJam7,
            'dataIbadahMingguJam9' => $dataIbadahMingguJam9,
        ];
        return view('Frontend.jadwalIbadah',$data);
    }
    public function kesaksian(){
        $dataKesaksian = kesaksianModel::orderByRaw("SUBSTRING_INDEX(testimony_id, '/', -1) + 0 ASC LIMIT 5")->get();
        $data = [
            'dataKesaksian' => $dataKesaksian,
            'data' => 'KESAKSIAN'
        ];
        return view('Frontend.kesaksian',$data);
    }
    public function renungan(){
        $dataRenungan = renunganModel::whereRaw('month(created_at) ='.date('m'))->whereRaw('year(created_at) ='.date('Y'))->orderByRaw("SUBSTRING_INDEX(reflection_id, '/', -1) + 0 DESC")->get();
        $data = [
            'dataRenungan' => $dataRenungan,
            'data' => 'RENUNGAN'
        ];
        return view('Frontend.renungan',$data);
    }
    public function getRenunganById(){
        $dataRenungan = renunganModel::where('reflection_id',$_POST['reflection_id'])->get();
        $content = "";
        if($dataRenungan[0]->contents == "-"){
            $content = "<center> <b> DATA BELUM DI ISI OLEH ADMIN GEREJA </b> </center>";
        }else{
            $content = $dataRenungan[0]->contents;
        }
        $isi = '';
        $isi.='
            <div class="row" style="text-align:justify;">
                <div class="col-lg-12 mt-4">
                    <center><h4>'.strtoupper($dataRenungan[0]->reflection_title).'</h4></center>
                </div>
                <div class="col-lg-12">
                    <font>'.$dataRenungan[0]->bible_verse.'</font><br>
                    <font><i>'.$dataRenungan[0]->verse.'</i></font>
                </div>
                <div class="col-lg-12 mt-4">
                    <font>'.$content.'</font>
                </div>
                <div class="col-lg-12 mt-5 copyright" style="font-size:13px;margin-bottom:-5px;">
                    2022 OLEH GEREJA SION WKO HALMAHERA UTARA <br>
                    &copy; ALL RIGHTS RESERVED
                </div>
            </div>
        ';
        return $isi;
    }
    function dataStatistikJemaat(){
        $services = dataJemaatModel::select('service_environtment')->groupBy('service_environtment')->pluck('service_environtment');
        $tempData = [

        ];
        $tempEducation = [];
        foreach($services as $service_i){
        $serviceData = DB::select('SELECT "'.$service_i.'" as LP, KK.*,JIWA.*,DEWASA.*,ANAK.*,BAPTIS.*,SIDI.*,NIKAH.*,ANAK_SM.*,REMAJA.*,PEMUDA.*,JND.*,DD.*,YTM.*,PTU.*,YP.*,LANSIA.* FROM (SELECT COUNT(DISTINCT tb_data_jemaat.familyCard_id) AS KK FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'") AS KK CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS JIWA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS JIWA_P, COUNT(*) AS JIWA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'") AS JIWA CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS DEWASA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS DEWASA_P, COUNT(*) AS DEWASA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 26 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 45) AS DEWASA CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS ANAK_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS ANAK_P, COUNT(*) AS ANAK_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 5 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 12) AS ANAK CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS BAPTIS_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS BAPTIS_P, COUNT(*) AS BAPTIS_JLH FROM tb_data_baptis) AS BAPTIS CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS SIDI_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS SIDI_P, COUNT(*) AS SIDI_JLH FROM tb_data_sidi) AS SIDI CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN marriage = "Kawin Tercatat" THEN 1 ELSE 0 END),0) AS NIKAH_SD, COALESCE(SUM(CASE WHEN marriage = "Belum Kawin" THEN 1 ELSE 0 END),0) AS NIKAH_BLM FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'") AS NIKAH CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS ANAK_SM_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS ANAK_SM_P, COUNT(*) AS ANAK_SM_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 0 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 5) AS ANAK_SM CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS REMAJA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS REMAJA_P, COUNT(*) AS REMAJA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 12 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 16) AS REMAJA CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS PEMUDA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS PEMUDA_P, COUNT(*) AS PEMUDA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 16 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 25) AS PEMUDA CROSS JOIN (SELECT COUNT(*) AS JND FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND marriage = "Cerai" AND gender = "female") AS JND CROSS JOIN (SELECT COUNT(*) AS DD FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND marriage = "Cerai" AND gender = "male") AS DD CROSS JOIN (SELECT COUNT(*) AS YTM FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND fatherName = "-" AND motherName != "-") AS YTM CROSS JOIN (SELECT COUNT(congregation_id) AS PTU FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND fatherName != "-" AND motherName = "-") AS PTU CROSS JOIN (SELECT COUNT(*) AS YP FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = "'.$service_i.'" AND fatherName = "-" AND motherName = "-") AS YP CROSS JOIN (SELECT COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) AS LANSIA_L, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) AS LANSIA_P, COUNT(*) AS LANSIA_JLH FROM tb_data_jemaat inner join tb_dtl_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id where tb_data_jemaat.service_environtment = "'.$service_i.'" AND (YEAR(CURDATE())-YEAR(date_ofBirth)) >= 46 AND (YEAR(CURDATE())-YEAR(date_ofBirth)) <= 65) AS LANSIA limit 1');

        $educationData =  DB::select('SELECT "'.$service_i.'" as LP, COUNT( DISTINCT tb_data_jemaat.familyCard_id) AS KK, 
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Strata III" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_S3,
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Strata III" AND gender = "female" THEN 1 ELSE 0 END ),0) AS P_S3,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Strata II" AND gender = "male" THEN 1 ELSE 0 END ),0) AS L_S2, 
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Strata II" AND gender = "female"THEN 1 ELSE 0 END ),0) AS P_S2, 
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Diploma IV/ Strata I" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_D4_S1,
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Diploma IV/ Strata I" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_D4_S1,
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Akademi/ Diploma III/ S.Muda" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_D3,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Akademi/ Diploma III/ S.Muda" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_D3,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Diploma I / II" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_D1_D2,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Diploma I / II" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_D1_D2,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "SLTA / Sederajat" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_SLTA,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "SLTA / Sederajat" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_SLTA,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "SLTP / Sederajat" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_SLTP,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "SLTP / Sederajat" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_SLTP,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Tamat SD / Sederajat" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_SD,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Tamat SD / Sederajat" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_SD, 
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Tidak / Belum Sekolah" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_TIDAK_SEKOLAH,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Tidak / Belum Sekolah" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_TIDAK_SEKOLAH,
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Belum Tamat SD / Sederajat" AND gender = "male" THEN 1 ELSE 0 END),0) AS L_BELUM_TAMAT,  
        COALESCE(SUM(CASE WHEN tb_dtl_kartu_keluarga.education = "Belum Tamat SD / Sederajat" AND gender = "female" THEN 1 ELSE 0 END),0) AS P_BELUM_TAMAT, COALESCE(SUM(CASE WHEN gender = "male" THEN 1 ELSE 0 END),0) as L_JLH, COALESCE(SUM(CASE WHEN gender = "female" THEN 1 ELSE 0 END),0) as P_JLH, COUNT(tb_data_jemaat.congregation_id) as TOTAL,  COALESCE(SUM(CASE WHEN gender = "male" AND tb_kartu_keluarga.address != "Maluku Utara" THEN 1 ELSE 0 END),0) as L_LUAR_DAERAH,  COALESCE(SUM(CASE WHEN gender = "female" AND tb_kartu_keluarga.address != "Maluku Utara" THEN 1 ELSE 0 END),0) as P_LUAR_DAERAH,  COALESCE(SUM(CASE WHEN tb_kartu_keluarga.address != "Maluku Utara" THEN 1 ELSE 0 END),0) as JLH_LUAR_DAERAH
        FROM tb_data_jemaat INNER JOIN tb_dtl_kartu_keluarga ON tb_data_jemaat.familyCard_id = tb_dtl_kartu_keluarga.familyCard_id INNER JOIN tb_kartu_keluarga on tb_data_jemaat.familyCard_id = tb_kartu_keluarga.familyCard_id WHERE tb_data_jemaat.service_environtment = '.$service_i);
            array_push($tempData,$serviceData[0]);
            array_push($tempEducation,$educationData[0]);
        }
        $data = [
            'dataJemaat' => $tempData,
            'pendidikanJemaat' => $tempEducation
        ];
        return view('DataJemaat.Manage Jemaat.pdf',$data);
    }
    public function viewInfoBulletin(){
        $dataRapatEvaluasi = rapatEvaluasiModel::whereRaw('month(date)='.date($_POST['bulan']))->whereRaw('year(date)='.date('Y'))->get();
        $dataMajelis = pembagianMajelisModel::whereRaw('month(sermon_date)='.date($_POST['bulan']))->whereRaw('year(sermon_date)='.date('Y'))->get();
        $isi = '';
        $isi .='
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div> <h5> <i class="fas fa-people-carry"></i> <b> Rapat Evaluasi </b> </h5> </div> <hr>
                    <div style="text-align:left;">
                        <ul>';
                            foreach($dataRapatEvaluasi as $dRE){
                                $split = explode(':',$dRE->time);
                                $splitDate = explode(' ',$dRE->date);
                                $splitNewDate = explode('-',$splitDate[0]);
        $isi.='                 <li class="mt-2">'.$dRE->evaluationMeeting.'</li>
                                    <ul>
                                        <li>  Tanggal : '.$splitNewDate[2].'-'.$splitNewDate[1].'-'.$splitNewDate[0].' </li>
                                        <li>  Waktu : '.$split[0].':'.$split[1].' WIT </li>
                                        <li>  Tempat : '.$dRE->place.' </li>
                                    </ul>';                        
                            }
        $isi .='        </ul>
                    </div>
                </div>
                 <div class="col-lg-4" style="border-right:1px solid black;border-left:1px solid black">
                    <div> <h5> <i class="fas fa-sitemap"></i> <b> Pembagian Tugas </b> </h5> </div> <hr>
                    <div style="text-align:left;">
                        <ul>
                            <li> Majelis Ibadah Minggu </li>
                            <li> Pembagain Khadim </li>
                            <li> Penataan Bunga </li>
                            <li> Tim Musik </li>
                            <li> Tim Pujian </li>
                            <li> Penerima Tamu </li>
                        </ul>
                    </div>
                </div>
                 <div class="col-lg-4" >
                    <div> <h5> <i class="fas fa-newspaper"></i> <b> Pembagian Majelis </b> </h5> </div> <hr>
                    <div style="text-align:left;">
                        <ul>
                            <li> Kelompok 1 </li>
                            <li> Kelompok 2 </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <a href="javascript:void(0)" onclick="downloadBulletin()"> <i class="fas fa-file-pdf"></i> Download Bulletin </a>
                </div>
            </div>
        ';
        return $isi;
    }
    public function event(){
        $eventModel = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->whereRaw('year(sermon_date) ='.date('Y'))->get();
        $eventModelGanjil = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->whereRaw('year(sermon_date) ='.date('Y'))->whereRaw("SUBSTRING_INDEX(event_id,'/',-1) % 2")->get();
        $eventModelGenap = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->whereRaw('year(sermon_date) ='.date('Y'))->whereRaw("SUBSTRING_INDEX(event_id,'/',-1) % 2 = 0")->get();
        $data = [
            'eventModel' => $eventModel,
            'eventModelGanjil' => $eventModelGanjil,
            'eventModelGenap' => $eventModelGenap,
            'data' => 'KESAKSIAN'
        ];
        return view('Frontend.event',$data);
    }
    public function tentangKami(){
        return view('Frontend.tentangKami');
    }
}
