<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendEmailSionWKO;
use App\Models\ibadahModel;
use App\Models\kesaksianModel;
use App\Models\renunganModel;

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
            'isAyatHarian' => $isAyatHarian
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
    public function isiAyatHarian(){
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
        ];
        return view('Frontend.jadwalIbadah',$data);
    }
    public function kesaksian(){
        $dataKesaksian = kesaksianModel::orderByRaw("SUBSTRING_INDEX(testimony_id, '/', -1) + 0 ASC LIMIT 5")->get();
        $data = [
            'dataKesaksian' => $dataKesaksian
        ];
        return view('Frontend.kesaksian',$data);
    }
    public function renungan(){
        $dataRenungan = renunganModel::orderByRaw("SUBSTRING_INDEX(reflection_id, '/', -1) + 0 ASC LIMIT 5")->get();
        $data = [
            'dataRenungan' => $dataRenungan
        ];
        return view('Frontend.renungan',$data);
    }
    public function getRenunganById(){
        $dataRenungan = renunganModel::where('reflection_id',$_POST['reflection_id'])->get();
        $isi = '';
        $isi.='
            <div class="row" style="text-align:justify">
                <div class="col-lg-12 mt-4">
                    <center><h4>'.strtoupper($dataRenungan[0]->reflection_title).'</h4></center>
                </div>
                <div class="col-lg-12">
                    <font>'.$dataRenungan[0]->bible_verse.'</font><br>
                    <font><i>'.$dataRenungan[0]->verse.'</i></font>
                </div>
                <div class="col-lg-12 mt-4">
                    <font>'.$dataRenungan[0]->contents.'</font>
                </div>
                <div class="col-lg-12 mt-5 copyright" style="font-size:13px;margin-bottom:-5px;">
                    2022 OLEH GEREJA MASEHI DI HALMAHERA UTARA <br>
                    &copy; ALL RIGHTS RESERVED
                </div>
            </div>
        ';
        return $isi;
    }
}
