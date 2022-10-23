<?php

namespace App\Http\Controllers;

use App\Models\ibadahModel;
use App\Models\kategoriIbadahModel;
use App\Models\rapatEvaluasiModel;
use App\Models\pembagianMajelisModel;
use App\Models\khadimModel;
use App\Models\penataanBungaModel;
use App\Models\pemusikModel;
use App\Models\pujianModel;
use App\Models\penerimaTamuModel;
use App\Models\kartuKeluargaModel;
use App\Models\dataDetailKartuKeluargaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\bulletinCoverModel;
use App\Models\majelisIbadahMingguModel;
use Illuminate\Support\Facades\Storage;
use Exception;
use PDF;

class bulletinController extends Controller
{
    public function readBulletin(){
        return view('Bulletin.bulletin');
    }
    public function showBulletinCoverModel(){
        $dataBulletinCover = bulletinCoverModel::orderByRaw("SUBSTRING_INDEX(cover_id, '/', -1) + 0 ASC")->get();
        $row = $dataBulletinCover->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_cover = $dataBulletinCover[$row-1]->cover_id;
            $pisah = explode('/',$id_cover);
            $row = $pisah[3] + 1;
        }

        $date = date('m/Y');
        $split = explode('/', $date);
        $bulan = $split[0];
        $tahun = $split[1];
        $isi = '';
        if($_POST['cmd'] == "add"){
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="cover_id"> ID Cover </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="cover_id" required name="cover_id" value="'."COVER/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="cover"> Cover </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" class="form-control" id="cover" required name="cover">
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="month"> Bulan </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="month" class="form-control" id="month" required name="month" >
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="theme"> Tema </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="theme" required name="theme" placeholder="Tema">
                            </div>
                        </div>
                    </div>  
                </div>
            ';
        }else{
            $dataBulletinCover = bulletinCoverModel::where('cover_id',$_POST['cover_id'])->get();
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="cover_id"> ID Cover </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="cover_id" name="cover_id" value="'.$dataBulletinCover[0]->cover_id.'">
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="cover"> Cover </label>
                            </div>
                            <div class="col-xl-3">
                                <input type="file" class="form-control" id="cover" name="cover" >
                            </div>
                            <div class="col-xl-5">';
                                if($dataBulletinCover[0]->cover == NULL){
                                    $isi .='<img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:100px;width:150px;cursor:pointer;">';
                                }else{
                                    $isi .='<img src="'.asset('/uploads/BULLETIN/'.$dataBulletinCover[0]->cover).'" style="height:100px;width:150px;cursor:pointer;">';
                                }
        $isi .='            </div>
                        </div>
                    </div>  
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="month"> Bulan </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="month" class="form-control" id="month" name="month" value="'.date("Y")."-".$dataBulletinCover[0]->month.'">
                            </div>
                        </div>
                    </div>  
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="theme"> Tema </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="theme" class="form-control" id="theme" name="theme" value="'.$dataBulletinCover[0]->theme.'">
                            </div>
                        </div>
                    </div>  
                </div>
            ';
        }
        return $isi;
    }
    public function createBulletinCover(Request $request){
        //Cek Data
        $pisahTanggal = explode('-',$request->month);
        $dataBulletinCover = bulletinCoverModel::where('month',$pisahTanggal[1])->get();
        if(count($dataBulletinCover) == null){
            $date = date('m/Y');
            $split = explode('/', $date);
            $row = explode('/',$request->cover_id);
            if($request->hasFile('cover')){
                $coverName = $row[3].".".$split[0].".".$split[1].".";
                $extPhotoFile = $request->file('cover')->extension();
                $urlCover = Storage::disk('BULLETIN')->putFileAs('COVER',$request->file('cover'),$coverName.'.'.$extPhotoFile);
            }else{
                $urlCover = "";
            }

            $splitMonth = explode('-',$request->month);
            bulletinCoverModel::create([
                'cover_id' => $request->cover_id,
                'cover' => $urlCover,
                'theme' => $request->theme,
                'month' => $splitMonth[1]
            ]);
            return redirect('/adm/bulletin')->with(["status"=>"Data berhasil ditambahkan", "judul_alert" => "Berhasil" , "icon" => "success"]);
        }else{
            return redirect('/adm/bulletin')->with(["status"=>"Data bulan sudah pernah diisi", "judul_alert" => "Peringatan" , "icon" => "warning"]);
        } 
    }
    public function updateBulletinCover(Request $request){
        $dataBulletinCover = bulletinCoverModel::where('cover_id',$request->cover_id)->first();
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$request->cover_id);
        if($request->hasFile('cover')){
            $coverName = $row[3].".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('cover')->extension();
            $urlCover = Storage::disk('BULLETIN')->putFileAs('COVER',$request->file('cover'),$coverName.'.'.$extPhotoFile);
        }else{
            $urlCover = $dataBulletinCover->cover;
        }

        $splitMonth = explode('-',$request->month);
        bulletinCoverModel::where('cover_id',$request->cover_id)->update([
            'cover' => $urlCover,
            'month' => $splitMonth[1],
            'theme' => $request->theme
        ]);
        return redirect('/adm/bulletin')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function getAllBulletinCover(){
        $dataBulletinCoverModel = bulletinCoverModel::get();
        $isi = '';
        if(count($dataBulletinCoverModel) == null){
            $isi .='
                <tr>
                    <th colspan="5"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($dataBulletinCoverModel as $dBCM){
                $isi .='
                    <tr>
                        <td>'.$dBCM->cover_id.'</td>';
                        if($dBCM->cover == NULL){
                            $isi .='
                            <td>
                                <img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:100px;width:150px;cursor:pointer;">
                            </td>';
                        }else{
                            $isi .='
                            <td>
                                <img src="'.asset('/uploads/BULLETIN/'.$dBCM->cover).'" style="height:100px;width:150px;cursor:pointer;">
                            </td>';
                        }
                $bulan = "";
                if($dBCM->month == "1"){
                    $bulan = "Januari";
                }else if ($dBCM->month == "2") {
                    $bulan = "Februari";
                }else if($dBCM->month == "3"){
                    $bulan = "Maret";
                }else if($dBCM->month == "4"){
                    $bulan = "April";
                }else if($dBCM->month == "5"){
                    $bulan = "Mei";
                }else if($dBCM->month == "6"){
                    $bulan = "Juni";
                }else if($dBCM->month == "7"){
                    $bulan = "Juli";
                }else if($dBCM->month == "8"){
                    $bulan = "Agustus";
                }else if($dBCM->month == "9"){
                    $bulan = "September";
                }else if($dBCM->month == "10"){
                    $bulan = "Oktober";
                }else if($dBCM->month == "11"){
                    $bulan = "November";
                }else{
                    $bulan = "Desember";
                }
                $isi .='
                        <td>'.$bulan.'</td>
                        <td>'.$dBCM->theme.'</td>
                        <td>
                            <button onclick="editBulletinCoverModal(`'.$dBCM->cover_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteBulletinCover(`'.$dBCM->cover_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                ';
            }
        }
        return $isi;
    }
    public function getAllBulletin()
    {
        $bulletinDataModel = majelisIbadahMingguModel::selectRaw('month(sermon_date) as bulan')->join('tb_kategori_pelayanan','tb_kategori_pelayanan.serviceCategory_id','tb_majelis_ibadah_minggu.serviceCategory_id')->whereRaw('year(sermon_date)='.$_POST['tahun'])->groupByRaw('month(sermon_date)')->get();
        $isi = '';
        if(count($bulletinDataModel) == null){
            $isi .='
                <tr>
                    <th colspan="4"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            $row = 1;
            $bulan = "";
            foreach($bulletinDataModel as $bDM){
                if($bDM->bulan == "1"){
                    $bulan = "Januari";
                }else if ($bDM->bulan == "2") {
                    $bulan = "Februari";
                }else if($bDM->bulan == "3"){
                    $bulan = "Maret";
                }else if($bDM->bulan == "4"){
                    $bulan = "April";
                }else if($bDM->bulan == "5"){
                    $bulan = "Mei";
                }else if($bDM->bulan == "6"){
                    $bulan = "Juni";
                }else if($bDM->bulan == "7"){
                    $bulan = "Juli";
                }else if($bDM->bulan == "8"){
                    $bulan = "Agustus";
                }else if($bDM->bulan == "9"){
                    $bulan = "September";
                }else if($bDM->bulan == "10"){
                    $bulan = "Oktober";
                }else if($bDM->bulan == "11"){
                    $bulan = "November";
                }else{
                    $bulan = "Desember";
                }
                $isi .='
                        <tr>
                            <td>'.$row++.'</td>
                            <td>'.$bulan.'</td>
                            <td> Gereja Sion WKO </td>
                            <td>
                                <button class="btn btn-danger" onclick="downloadBulletin(`'.$bDM->bulan.'`)"> <i class="fas fa-download"></i> </button>
                            </td>
                        </tr>
                    ';
            }
        }
        return $isi;
    }
    public function deleteBulletinCover(){
        try{
            $ibadah = bulletinCoverModel::where('cover_id',$_POST['cover_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function downloadBulletin($bulan){
        $dataCover = bulletinCoverModel::where('month',date('m'))->first();
        //Data Ibadah Lingkungan
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

        //Data Rapat Evaluasi
        $dataRapatEvaluasi = rapatEvaluasiModel::whereRaw('month(date)='.date('m'))->whereRaw('year(date)='.date('Y'))->get();
        
        //Data Kelompok Majelis Ibadah Minggu
        $dataKelompokMajelisIbadahMinggu = majelisIbadahMingguModel::join('tb_kategori_pelayanan','tb_kategori_pelayanan.serviceCategory_id','tb_majelis_ibadah_minggu.serviceCategory_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->get();

        //Data Khadim
        $dataKhadim = khadimModel::join('tb_kategori_pelayanan','tb_kategori_pelayanan.serviceCategory_id','tb_khadim.serviceCategory_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->get();

        //Data Penataan Bunga
        $dataPenataanBunga = penataanBungaModel::join('tb_kategori_pelayanan','tb_kategori_pelayanan.serviceCategory_id','tb_penataan_bunga.serviceCategory_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->get();

        //Data Pemusik
        $dataPemusik = pemusikModel::join('tb_kategori_pelayanan','tb_kategori_pelayanan.serviceCategory_id','tb_pemusik.serviceCategory_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->get();

        //Data Pujian
        $dataPujian = pujianModel::join('tb_kategori_pelayanan','tb_kategori_pelayanan.serviceCategory_id','tb_pujian.serviceCategory_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->groupByRaw('sermon_date')->get();
        $dataPujian1 = DB::select('SELECT *FROM tb_pujian WHERE TIME = TIME("07:00:00") AND MONTH(sermon_date) = MONTH(CURDATE())');
        $dataPujian2 = DB::select('SELECT *FROM tb_pujian WHERE TIME = TIME("09:30:00") AND MONTH(sermon_date) = MONTH(CURDATE())');

        //Data Penerima Tamu
        $dataPenerimaTamu = penerimaTamuModel::join('tb_kategori_pelayanan','tb_kategori_pelayanan.serviceCategory_id','tb_penerima_tamu.serviceCategory_id')->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->groupByRaw('sermon_date')->get();
        $dataPenerimaTamu1 = DB::select('SELECT *FROM tb_penerima_tamu WHERE TIME = TIME("07:00:00") AND MONTH(sermon_date) = MONTH(CURDATE())');
        $dataPenerimaTamu2 = DB::select('SELECT *FROM tb_penerima_tamu WHERE TIME = TIME("07:00:00") AND MONTH(sermon_date) = MONTH(CURDATE())');

        //Daftar Hut Jemaat 
        $daftarHutJemaat = DB::select('SELECT tb_dtl_kartu_keluarga.fullName AS "Nama" , tb_dtl_kartu_keluarga.date_ofBirth AS "Tgl_lahir", (YEAR(CURDATE()) - YEAR(date_ofBirth)) AS "Umur", tb_data_jemaat.service_environtment AS "LP" FROM tb_dtl_kartu_keluarga INNER JOIN tb_data_jemaat ON tb_dtl_kartu_keluarga.familyCard_id = tb_data_jemaat.familyCard_id WHERE MONTH(date_ofBirth) = MONTH(CURDATE()) ORDER BY Nama ASC');

        //Daftar Pernikahan Jemaat
        $daftarNikahJemaat = DB::select('SELECT tb_dtl_kartu_keluarga.fullName AS "Nama" , tb_dtl_kartu_keluarga.date_ofMarriage AS "Tgl_Nikah", (YEAR(CURDATE()) - YEAR(date_ofBirth)) AS "Umur", tb_data_jemaat.service_environtment AS "LP" FROM tb_dtl_kartu_keluarga INNER JOIN tb_data_jemaat ON tb_dtl_kartu_keluarga.familyCard_id = tb_data_jemaat.familyCard_id WHERE  MONTH(date_ofMarriage) = MONTH(CURDATE()) AND tb_dtl_kartu_keluarga.date_ofMarriage IS NOT NULL AND tb_dtl_kartu_keluarga.marriage != "Cerai" ORDER BY Nama ASC');

        //Dafter Kelompok Majelis 
        $dataKelompokMajelis = pembagianMajelisModel::select('assembly_group')->with(['group_data' => function($query){
            return $query->whereRaw('month(sermon_date)='.date('m'))->whereRaw('year(sermon_date)='.date('Y'))->get();
        }])->withCount('group_data')->groupBy('assembly_group')->get();

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
            'dataCover' => $dataCover,
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
            'dataRapatEvaluasi' => $dataRapatEvaluasi,
            'dataKelompokMajelisIbadahMinggu' => $dataKelompokMajelisIbadahMinggu,
            'dataKhadim' => $dataKhadim,
            'dataPenataanBunga' => $dataPenataanBunga,
            'dataPemusik' => $dataPemusik,
            'dataPujian' => $dataPujian,
            'dataPujian1' => $dataPujian1,
            'dataPujian2' => $dataPujian2,
            'dataPenerimaTamu' => $dataPenerimaTamu,
            'dataPenerimaTamu1' => $dataPenerimaTamu1,
            'dataPenerimaTamu2' => $dataPenerimaTamu2,
            'daftarHutJemaat' => $daftarHutJemaat,
            'daftarNikahJemaat' => $daftarNikahJemaat,
            'dataKelompokMajelis' => $dataKelompokMajelis
        ];
        $pdf = PDF::loadView('Bulletin.downloadBulletin', $data);
		return $pdf->download('Bulletin/'.$bulan.'.pdf');		
        //return view('Bulletin.downloadBulletin',$data);
    }
}
