<?php

namespace App\Http\Controllers;

use App\Models\dataBaptisModel;
use Illuminate\Http\Request;
use App\Models\dataJemaatModel;
use App\Models\dataSIDIModel;
use App\Models\kartuKeluargaModel;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use PDF;

class dataJemaatController extends Controller
{
    //Data Jemaat
    public function createDataJemaat(Request $request){
        if($request->service_environtment == "-"){
            return redirect('/adm/dataJemaat')->with(["status"=>"Lingkungan Pelayanan tidak boleh kosong", "judul_alert" => "Peringatan" , "icon" => "warning"]);
        }
        if($request->baptism_id != "-" || $request->sidi_id != "-"){
           $cekDataBaptis = dataJemaatModel::where('baptism_id',$request->baptism_id)->get();
            if(count($cekDataBaptis) != 0){
                return redirect('/adm/dataJemaat')->with(["status"=>"ID Baptis sudah pernah disimpan", "judul_alert" => "Peringatan" , "icon" => "warning"]);
            }
            $cekDataSIDI = dataJemaatModel::where('sidi_id',$request->sidi_id)->get();
            if(count($cekDataSIDI) != 0){
                return redirect('/adm/dataJemaat')->with(["status"=>"ID SIDI sudah pernah disimpan", "judul_alert" => "Peringatan" , "icon" => "warning"]);
            }
            $dataJemaat = dataJemaatModel::where('service_environtment',$request->service_environtment)->where('familyCard_id',$request->familyCard_id)->get();
            if(count($dataJemaat) != 0){
                return redirect('/adm/dataJemaat')->with(["status"=>"KK dengan LP tersebut sudah pernah tersimpan", "judul_alert" => "Peringatan" , "icon" => "warning"]);
            }
        }
        dataJemaatModel::create($request->all());
        return redirect('/adm/dataJemaat')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function readDataJemaat(Request $request){
        $dataJemaat = dataJemaatModel::get();
        $row = $dataJemaat->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $dataJemaat = array_slice($dataJemaat->toArray(),$starting_point,$per_page,true);
        $dataJemaat= new LengthAwarePaginator($dataJemaat, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'dataJemaat' => $dataJemaat
        ];
        return view('DataJemaat.Manage Jemaat.index',$data);
    }
    public function updateDataJemaat(Request $request){
        try{
            dataJemaatModel::where('congregation_id',$request->congregation_id)->update([
                'baptism_id' => $request->baptism_id,
                'sidi_id' => $request->sidi_id,
                'familyCard_id' => $request->familyCard_id,
                'service_environtment' => $request->service_environtment
            ]);
            return redirect('/adm/dataJemaat')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function deleteDataJemaat(){
        try{
            dataJemaatModel::where('congregation_id',$_POST['congregation_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showDataJemaat(){
        $dataJemaat = dataJemaatModel::orderByRaw("SUBSTRING_INDEX(congregation_id, '/', -1) + 0 ASC")->get();
        $dataSIDI = dataSIDIModel::get();
        $dataBaptis = dataBaptisModel::get();
        $dataKK = kartuKeluargaModel::get();
        $row = $dataJemaat->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_jemaat = $dataJemaat[$row-1]->congregation_id;
            $pisah = explode('/',$id_jemaat);
            $row = $pisah[1] + 1;
        }
        $isi = '';
        if($_POST['cmd'] == "add"){
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-4">
                                <label for="congregation_id"> ID Data Jemaat </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="congregation_id" name="congregation_id" value="'."DAJA/".$row.'">
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-4">
                                <label for="baptism_id"> Baptis </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" name="baptism_id" id="baptism_id">
                                    <option value="-"> -- Baptis -- </option>';
                                    foreach ($dataBaptis as $key => $dB) {
                                        $isi .='<option value="'.$dB->baptism_id.'"> '.$dB->baptism_id.' </option>';                                                                       
                                    }
            $isi .='            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sidi_id"> SIDI </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" id="sidi_id" name="sidi_id">
                                    <option value="-" > -- SIDI -- </option>';
                                    foreach ($dataSIDI as $key => $dS) {
                                        $isi .='<option value="'.$dS->sidi_id.'"> '.$dS->sidi_id.' </option>';                                                                       
                                    }
            $isi .='            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="familyCard_id"> Kartu Keluarga </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" name="familyCard_id" id="familyCard_id">
                                    <option value="-"> -- Kartu Keluarga --  </option>';
                                    foreach ($dataKK as $key => $dKK) {
                                        $isi .='<option value="'.$dKK->familyCard_id.'"> '.$dKK->familyCard_id.' </option>';                                                                       
                                    }
            $isi .='            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="service_environtment"> LP </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" required name="service_environtment" id="service_environtment">
                                    <option value="-"> -- Lingkungan Pelayanan -- </option>
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                    <option value="4"> 4 </option>
                                    <option value="5"> 5 </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $dataJemaatModel = dataJemaatModel::where('congregation_id',$_POST['congregation_id'])->first();
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-4">
                                <label for="congregation_id"> ID Data Jemaat </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="congregation_id" name="congregation_id" value="'.$dataJemaatModel->congregation_id.'">
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-4">
                                <label for="baptism_id"> Baptis </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" required name="baptism_id" id="baptism_id">
                                    <option value="-"> -- Baptis -- </option>';
                                        $stringBaptismId = "";
                                        foreach($dataBaptis as $dB){
                                            $stringBaptismId .= $dB->baptism_id.",";
                                        }
                                        $baptis = explode(',',substr($stringBaptismId,0,-1));
                                        foreach($baptis as $sE){
                                            if($dataJemaatModel->baptism_id == $sE){
                                                $isi .='<option value="'.$dataJemaatModel->baptism_id.'" selected>'.$dataJemaatModel->baptism_id.'</option>';
                                            }
                                        }
                                        $sER = array_diff($baptis, array($dataJemaatModel->baptism_id));
                                        foreach($sER as $sEr){
                                            $isi .='<option value="'.$sEr.'">'.$sEr.'</option>';
                                        }
            $isi .='            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sidi_id"> SIDI </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" id="sidi_id" name="sidi_id">
                                    <option value="-"> -- Baptis -- </option>';
                                        $stringSIDIId = "";
                                        foreach($dataSIDI as $dS){
                                            $stringSIDIId .= $dS->sidi_id.",";
                                        }
                                        $SIDI = explode(',',substr($stringSIDIId,0,-1));
                                        foreach($SIDI as $sE){
                                            if($dataJemaatModel->sidi_id == $sE){
                                                $isi .='<option value="'.$dataJemaatModel->sidi_id.'" selected>'.$dataJemaatModel->sidi_id.'</option>';
                                            }
                                        }
                                        $sER = array_diff($SIDI, array($dataJemaatModel->sidi_id));
                                        foreach($sER as $sEr){
                                            $isi .='<option value="'.$sEr.'">'.$sEr.'</option>';
                                        }
            $isi .='            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="familyCard_id"> Kartu Keluarga </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" name="familyCard_id" id="familyCard_id">
                                    <option value="-"> -- Baptis -- </option>';
                                        $stringKartuKeluarga = "";
                                        foreach($dataKK as $dKK){
                                            $stringKartuKeluarga .= $dKK->familyCard_id.",";
                                        }
                                        $SIDI = explode(',',substr($stringKartuKeluarga,0,-1));
                                        foreach($SIDI as $sE){
                                            if($dataJemaatModel->familyCard_id == $sE){
                                                $isi .='<option value="'.$dataJemaatModel->familyCard_id.'" selected>'.$dataJemaatModel->familyCard_id.'</option>';
                                            }
                                        }
                                        $sER = array_diff($SIDI, array($dataJemaatModel->familyCard_id));
                                        foreach($sER as $sEr){
                                            $isi .='<option value="'.$sEr.'">'.$sEr.'</option>';
                                        }
            $isi .='            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="service_environtment"> LP </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" required name="service_environtment" id="service_environtment">
                                    <option value="-"> -- Lingkungan Pelayanan -- </option>';
                                    $service_environtment = array("1","2","3","4","5");
                                    foreach($service_environtment as $sE){
                                        if($dataJemaatModel->service_environtment == $sE){
                                            $isi .='<option value="'.$dataJemaatModel->service_environtment.'" selected>'.$dataJemaatModel->service_environtment.'</option>';
                                        }
                                    }
                                    $sER = array_diff($service_environtment, array($dataJemaatModel->service_environtment));
                                    foreach($sER as $sEr){
                                        $isi .='<option value="'.$sEr.'">'.$sEr.'</option>';
                                    }
            $isi .='            </select>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
    public function getAllDataJemaat(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataJemaat = dataJemaatModel::orderByRaw("SUBSTRING_INDEX(congregation_id, '/', -1) + 0 DESC")->get();
        $count = count($dataJemaat);
        $currentItems = $dataJemaat->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        print_r($paginator);
        $isi = '';
        if(count($dataJemaat) <= 0){
            $isi .='
                <tr>
                    <th colspan="7"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            $row = 1;
            foreach($paginator as $dJ){
                $isi .='
                    <tr>
                        <td>'.$row++.'</td>
                        <td>'.$dJ->congregation_id.'</td>
                        <td>'.$dJ->baptism_id.'</td>
                        <td>'.$dJ->sidi_id.'</td>
                        <td>'.$dJ->familyCard_id.'</td>
                        <td>'.$dJ->service_environtment.'</td>
                        <td>
                            <button onclick="editDataJemaatModel(`'.$dJ->congregation_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deteleDataJemaat(`'.$dJ->congregation_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                ';
            }
        }
        $isi .= '###'.$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function downloadDataJemaat(){
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
        $pdf = PDF::loadView('DataJemaat.Manage Jemaat.pdf', $data)->setPaper('a4', 'landscape');;
		return $pdf->download('All Data Jemaat.pdf');	
        //return view('DataJemaat.Manage Jemaat.pdf',$data);
    }
    public function downloadManageJemaat(){
        $dataJemaat = DB::select('SELECT fullName AS NAMA, place_ofBirth AS ALAMAT, IF(gender = "male", 1,0) AS L, IF(gender = "female", 1,0) AS P, (YEAR(CURDATE()) - YEAR(date_ofBirth)) AS "Umur", date_ofMarriage AS NIKAH, IF(tb_data_jemaat.baptism_id != "-" AND gender = "male", 1, 0 ) AS L_BAPTIS, IF(tb_data_jemaat.baptism_id != "-" AND gender = "female", 1, 0 ) AS P_BAPTIS, IF(tb_data_jemaat.sidi_id != "-" AND gender = "male", 1, 0 ) AS L_SIDI, IF(tb_data_jemaat.sidi_id != "-" AND gender = "female", 1, 0 ) AS P_SIDI, IF(gender = "male" AND marriage = "Kawin Tercatat", 1,0) AS L_NIKAH, IF(gender = "female" AND marriage = "Kawin Tercatat", 1,0) AS P_NIKAH, education AS PENDIDIKAN, job AS JENIS_PENDIDIKAN, marriage AS STATUS_PERKAWINAN, family_status AS STATUS_HUB_KELUARGA FROM tb_data_jemaat INNER JOIN tb_dtl_kartu_keluarga ON tb_data_jemaat.familyCard_id GROUP BY NAMA');
        $data = [
            'dataJemaat' => $dataJemaat
        ];
        $pdf = PDF::loadView('DataJemaat.Manage Jemaat.pdfJemaat', $data)->setPaper('a4', 'landscape');;
		return $pdf->download('Data Jemaat.pdf');	
        //return view('DataJemaat.Manage Jemaat.pdfJemaat',$data);
    }
}
