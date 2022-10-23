<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataDetailKartuKeluargaModel;
use App\Models\kartuKeluargaModel;
use App\Models\tempDetailKartuKeluargaModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class kartuKeluargacontroller extends Controller
{
    public function readKartuKeluarga(Request $request){
        $kartuKeluarga = kartuKeluargaModel::get();
        $row = $kartuKeluarga->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $kartuKeluarga = array_slice($kartuKeluarga->toArray(),$starting_point,$per_page,true);
        $kartuKeluarga= new LengthAwarePaginator($kartuKeluarga, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'kartuKeluarga' => $kartuKeluarga
        ];
        return view('DataJemaat.KartuKeluarga.index',$data);
    }
    public function updateKartuKeluarga(Request $request){
        $dataKartuKeluargaByID = kartuKeluargaModel::where('familyCard_id',$_POST['familyCard_id'])->first();
        $date = date('m/Y');
        $split = explode('/', $date);
        
        if($request->hasFile('photo')){
            $photoName = $request->familyCard_id.".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('KARTUKELUARGA')->putFileAs('Photo',$request->file('photo'),$photoName.'.'.$extPhotoFile);
        }else{
            $urlPhotoFile = $dataKartuKeluargaByID->photo;
        }

        kartuKeluargaModel::where('familyCard_id',$_POST['familyCard_id'])->update([
            'family_headName' => $request->family_headName,
            'address' => $request->address,
            'RTRW' => $request->RTRW,
            'zipCode' => $request->zipCode,
            'photo' => $urlPhotoFile
        ]);
        return redirect('/adm/dataJemaat/kartuKeluarga')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function updateDetailKartuKeluarga(Request $request){
        $number = dataDetailKartuKeluargaModel::where('NIK',$request->NIK)->first();
        try{
            dataDetailKartuKeluargaModel::where('NIK',$request->NIK)->update([
                'familyCard_id' => $request->familyCard_id,
                'fullName' => $request->fullName,
                'gender' => $request->gender,
                'place_ofBirth' => $request->place_ofBirth,
                'date_ofBirth' => $request->date_ofBirth,
                'religion' => $request->religion,
                'education' => $request->education,
                'job' => $request->job,
                'blood' => $request->blood,
                'marriage' => $request->marriage,
                'date_ofMarriage' => $request->date_ofMarriage,
                'family_status' => $request->family_status,
                'citizenship' => $request->citizenship,
                'paspor' => $request->paspor,
                'fatherName' => $request->fatherName,
                'motherName' => $request->motherName,
            ]);
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function updateTempDetailKartuKeluarga(Request $request){
        try{
            tempDetailKartuKeluargaModel::where('NIK',$request->NIK)->update([
                'familyCard_id' => $request->familyCard_id,
                'fullName' => $request->fullName,
                'gender' => $request->gender,
                'place_ofBirth' => $request->place_ofBirth,
                'date_ofBirth' => $request->date_ofBirth,
                'religion' => $request->religion,
                'education' => $request->education,
                'job' => $request->job,
                'blood' => $request->blood,
                'marriage' => $request->marriage,
                'date_ofMarriage' => $request->date_ofMarriage,
                'family_status' => $request->family_status,
                'citizenship' => $request->citizenship,
                'paspor' => $request->paspor,
                'fatherName' => $request->fatherName,
                'motherName' => $request->motherName,
            ]);
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function createKartuKeluarga(Request $request){
        $date = date('m/Y');
        $split = explode('/', $date);
        
        if($request->hasFile('photo')){
            $photoName = $request->familyCard_id.".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('KARTUKELUARGA')->putFileAs('Photo',$request->file('photo'),$photoName.'.'.$extPhotoFile);
        }else{
            $urlPhotoFile = "";
        }

        kartuKeluargaModel::create([
            'familyCard_id' => $request->familyCard_id,
            'family_headName' => $request->family_headName,
            'address' => $request->address,
            'RTRW' => $request->RTRW,
            'zipCode' => $request->zipCode,
            'photo' => $urlPhotoFile
        ]);

        DB::statement('UPDATE tb_temp_dtl_kartu_keluarga SET familyCard_id= :familyCard_id',['familyCard_id' => $request->familyCard_id]);

        DB::insert("INSERT INTO tb_dtl_kartu_keluarga (familyCard_id,fullName,NIK,gender,place_ofBirth,date_ofBirth,religion, education, job, blood, marriage, date_ofMarriage, family_status, citizenship, paspor, fatherName, motherName, created_at, updated_at)   SELECT familyCard_id,fullName,NIK,gender,place_ofBirth,date_ofBirth,religion, education, job, blood, marriage, date_ofMarriage, family_status, citizenship, paspor, fatherName, motherName, created_at, updated_at FROM tb_temp_dtl_kartu_keluarga");

        tempDetailKartuKeluargaModel::truncate();

        return redirect('/adm/dataJemaat/kartuKeluarga')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function createTempDetailKartuKeluarga(Request $request){
        $dataKK = kartuKeluargaModel::where('familyCard_id',$request->familyCard_id)->first();
        if($dataKK != NULL){
            $number = dataDetailKartuKeluargaModel::where('NIK',$request->NIK)->first();
            if($number == NULL){
                $count = 1;
            }else{
                $count = count($number[0]) + 1;
            }
            try{
                dataDetailKartuKeluargaModel::create([
                    'familyCard_id' => $request->familyCard_id,
                    'fullName' => $request->fullName,
                    'gender' => $request->gender,
                    'place_ofBirth' => $request->place_ofBirth,
                    'date_ofBirth' => $request->date_ofBirth,
                    'religion' => $request->religion,
                    'education' => $request->education,
                    'job' => $request->job,
                    'blood' => $request->blood,
                    'marriage' => $request->marriage,
                    'date_ofMarriage' => $request->date_ofMarriage,
                    'family_status' => $request->family_status,
                    'citizenship' => $request->citizenship,
                    'paspor' => $request->paspor,
                    'fatherName' => $request->fatherName,
                    'motherName' => $request->motherName,
                ]);
                return "success";
            }
            catch(Exception $ex){
                throw $ex;
            }
        }else{
            $row = tempDetailKartuKeluargaModel::where('familyCard_id',$request->familyCard_id)->first();
            if($row == NULL){
                $count = 1;
            }else{
                $count = count($row[0]) + 1;
            }
            try{
                tempDetailKartuKeluargaModel::create([
                    'NIK' => $request->NIK,
                    'familyCard_id' => "",
                    'fullName' => $request->fullName,
                    'gender' => $request->gender,
                    'place_ofBirth' => $request->place_ofBirth,
                    'date_ofBirth' => $request->date_ofBirth,
                    'religion' => $request->religion,
                    'education' => $request->education,
                    'job' => $request->job,
                    'blood' => $request->blood,
                    'marriage' => $request->marriage,
                    'date_ofMarriage' => $request->date_ofMarriage,
                    'family_status' => $request->family_status,
                    'citizenship' => $request->citizenship,
                    'paspor' => $request->paspor,
                    'fatherName' => $request->fatherName,
                    'motherName' => $request->motherName,
                ]);
                return "success";
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
    }
    public function getAllKartuKeluarga(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $kartuKeluargaModel = kartuKeluargaModel::orderByRaw("SUBSTRING_INDEX(familyCard_id, '/', -1) + 0 DESC")->get();
        $count = count($kartuKeluargaModel);
        $currentItems = $kartuKeluargaModel->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';
        if(count($kartuKeluargaModel) <= 0){
            $isi .='
                <tr>
                    <th colspan="7"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($paginator as $kKM){
                $isi .='
                    <tr>
                        <td>'.$kKM->familyCard_id.'</td>
                        <td>'.$kKM->family_headName.'</td>
                        <td>'.$kKM->address.'</td>
                        <td>'.$kKM->RTRW.'</td>
                        <td>'.$kKM->zipCode.'</td>';
                        if($kKM->photo == NULL){
                        $isi .='
                            <td>    
                                <img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:30px;width:60px;">
                            </td>';
                        }else{
                        $isi .='
                            <td>
                                <img src="'.asset('/uploads/KARTUKELUARGA/'.$kKM->photo).'" style="height:30px;width:60px;">
                            </td>';
                        }
                $isi .='
                        <td>
                            <button onclick="editKartuKeluargaModal(`'.$kKM->familyCard_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteKartuKeluarga(`'.$kKM->familyCard_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi; 
    }
    public function getTempDetailKartuKeluarga(){
        $detailTempKartuKeluargaModel = tempDetailKartuKeluargaModel::get();
        $data = [
            'detailTempKartuKeluargaModel' => $detailTempKartuKeluargaModel
        ];
        return view('DataJemaat.KartuKeluarga.detailAdd',$data);
    }
    public function getDetailKartuKeluarga(){
        $detailKartuKeluargaModel = dataDetailKartuKeluargaModel::where('familyCard_id',$_POST['familyCard_id'])->get();
        $data = [
            'detailKartuKeluargaModel' => $detailKartuKeluargaModel
        ];
        return view('DataJemaat.KartuKeluarga.detailEdit',$data);
    }
    public function deleteDetailKartuKeluarga(){
        //TAMBAHAN DELETE PAKAI NUMBER
        dataDetailKartuKeluargaModel::where('NIK',$_POST['NIK'])->delete();
        return "success";
    }
    public function deleteTempDetailKartuKeluarga(){
        tempDetailKartuKeluargaModel::where('NIK',$_POST['NIK'])->delete();
        return "success";
    }
    public function deleteKartuKeluarga(){
        try{
            //Delete Detail Kartu Keluarga
            dataDetailKartuKeluargaModel::where('familyCard_id',$_POST['familyCard_id'])->delete();
            //Delete Kartu Keluarga
            kartuKeluargaModel::where('familyCard_id',$_POST['familyCard_id'])->delete();

            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showKartuKeluargaModel(){
        $isi = '';
        if($_POST['cmd'] == "add"){
            $isi .='
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="familyCard_id"> No KK </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="familyCard_id" name="familyCard_id" placeholder="Masukan No KK">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="family_headName"> Kepala Keluarga </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="family_headName" name="family_headName" placeholder="Masukan Nama Kepala Keluarga">     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="address"> Alamat </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="address" name="address" placeholder="Masukan Alamat">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="RT/RW"> RT/RW </label>
                            </div>
                            <div class="col-xl-8">
                            <input type="text" class="form-control" required id="RTRW" name="RTRW" placeholder="Masukan RT/RW">     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="zipCode"> Kode Pos </label>
                            </div>
                            <div class="col-xl-8">
                            <input type="text" class="form-control" required id="zipCode" name="zipCode" placeholder="Masukan Kode Pos">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="photo"> Foto </label>
                            </div>
                            <div class="col-xl-8">
                            <input type="file" class="form-control" required id="photo" name="photo">     
                            </div>
                        </div>
                    </div>
                </div>
            ';
            $isi .=$this->showDetailKartuKeluargaModel("add");
        }else{
            $kartuKeluargaModel = kartuKeluargaModel::where('familyCard_id',$_POST['familyCard_id'])->first();
            $isi .='
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="familyCard_id"> No KK </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="familyCard_id" name="familyCard_id" value="'.$kartuKeluargaModel->familyCard_id.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="family_headName"> Kepala Keluarga </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="family_headName" name="family_headName" value="'.$kartuKeluargaModel->family_headName.'">     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="address"> Alamat </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="address" name="address" value="'.$kartuKeluargaModel->address.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="RT/RW"> RT/RW </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="RTRW" name="RTRW" value="'.$kartuKeluargaModel->RTRW.'">     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="zipCode"> Kode Pos </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="zipCode" name="zipCode" value="'.$kartuKeluargaModel->zipCode.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="photo"> Foto </label>
                            </div>
                            <div class="col-xl-3">
                                <input type="file" class="form-control" id="photo" name="photo">     
                            </div>
                            <div class="col-xl-5">';
                            if($kartuKeluargaModel->photo == NULL){
                                $isi .='<img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:50px;width:70px;">';
                            }else{
                                $isi .='<img src="'.asset('/uploads/KARTUKELUARGA/'.$kartuKeluargaModel->photo).'" style="height:50px;width:70px;">';
                            }
            $isi .='        </div>
                        </div>
                    </div>
                </div>
            ';
            $isi .=$this->showDetailKartuKeluargaModel("add");
        }
        return $isi;
    } 
    public function showDetailKartuKeluargaModel($cmd){
        $isi = '';
        if($cmd == "edit"){
            $dataDetailKartuKeluarga = dataDetailKartuKeluargaModel::where('NIK',$_POST['NIK'])->first();
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="table-responsive col-lg-12 float-left" id="data-output">
                            <div class="py-3">
                                <div class="p-3 pt-4 col-lg-12 position-relative float-left" style="border:1px solid black;">
                                <span style="position:absolute;top:-12.5px ;left:15px;background:white;padding:0 8px;"> Detail Kartu Keluarga </span>
                                    <div class="mb-3">
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" readonly name="NIK" id="NIK" value="'.$dataDetailKartuKeluarga->NIK.'"> 
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" name="fullName" id="fullName" value="'.$dataDetailKartuKeluarga->fullName.'">
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="-"> -- Jenis Kelamin -- </option>';
                                                if($dataDetailKartuKeluarga->gender == "male"){
                                                    $isi .='
                                                        <option value="'.$dataDetailKartuKeluarga->gender.'" selected="selected" > Laki - laki</option>
                                                        <option value="female"> Perempuan </option>';
                                                }else{
                                                    $isi .='
                                                        <option value="male"> Laki-laki </option>
                                                        <option value="'.$dataDetailKartuKeluarga->gender.'" selected="selected" > Perempuan </option>';
                                                }
            $isi .='                        </select>
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" name="place_ofBirth" id="place_ofBirth" value="'.$dataDetailKartuKeluarga->place_ofBirth.'">
                                        </div>';
                                        $tanggal_lahir = explode(' ',$dataDetailKartuKeluarga->date_ofBirth);
            $isi .='                    <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" value="'.$tanggal_lahir[0].'" onfocus="(this.type=`date`)" class="form-control" name="date_ofBirth" id="date_ofBirth">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="religion" id="religion">
                                                <option value="-"> -- Agama -- </option>';    
                                                $religion = array("CHRISTIAN","MUSLIM","BUDDHA","KONGHUCU","CATHOLIC","HINDU");
                                                foreach($religion as $r){
                                                    if($dataDetailKartuKeluarga->religion == $r){
                                                        $isi .='<option value="'.$dataDetailKartuKeluarga->religion.'" selected>'.$dataDetailKartuKeluarga->religion.'</option>';
                                                    }
                                                }
                                                $reR = array_diff($religion, array($dataDetailKartuKeluarga->religion));
                                                foreach($reR as $rR){
                                                    $isi .='<option value="'.$rR.'">'.$rR.'</option>';
                                                }
            $isi .='                                                         
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="education" id="education">
                                                <option value="-"> -- Pendidikan -- </option>';
                                                $education = array("Tidak / Belum Sekolah","Belum Tamat SD / Sederajat","Tamat SD / Sederajat","SLTP / Sederajat","SLTA / Sederajat","Diploma I / II","Akademi/ Diploma III/ S.Muda","Diploma IV / Strata I","Strata II","Strata III");
                                                foreach($education as $e){
                                                    if($dataDetailKartuKeluarga->education == $e){
                                                        $isi .='<option value="'.$dataDetailKartuKeluarga->education.'" selected>'.$dataDetailKartuKeluarga->education.'</option>';
                                                    }
                                                }
                                                $reE = array_diff($education, array($dataDetailKartuKeluarga->education));
                                                foreach($reE as $rE){
                                                    $isi .='<option value="'.$rE.'">'.$rE.'</option>';
                                                }
            $isi .='                        </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="job" id="job" value="'.$dataDetailKartuKeluarga->job.'">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="blood" id="blood">
                                                <option value="-"> -- Gol Darah -- </option>';
                                                $blood = array("A","B","O","AB");
                                                foreach($blood as $b){
                                                    if($dataDetailKartuKeluarga->blood == $b){
                                                        $isi .='<option value="'.$dataDetailKartuKeluarga->blood.'" selected>'.$dataDetailKartuKeluarga->blood.'</option>';
                                                    }
                                                }
                                                $reB = array_diff($blood, array($dataDetailKartuKeluarga->blood));
                                                foreach($reB as $rB){
                                                    $isi .='<option value="'.$rB.'">'.$rB.'</option>';
                                                }
            $isi .='                        </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="marriage" id="marriage">
                                                <option value="-"> -- Status Perkawinan -- </option>';
                                                $marriage = array("Kawin Tercatat","Belum Kawin","Cerai");
                                                foreach($marriage as $m){
                                                    if($dataDetailKartuKeluarga->marriage == $m){
                                                        $isi .='<option value="'.$dataDetailKartuKeluarga->marriage.'" selected>'.$dataDetailKartuKeluarga->marriage.'</option>';
                                                    }
                                                }
                                                $reB = array_diff($marriage, array($dataDetailKartuKeluarga->marriage));
                                                foreach($reB as $rB){
                                                    $isi .='<option value="'.$rB.'">'.$rB.'</option>';
                                                }
            $isi .='                        </select>
                                        </div>';
                                        $date_ofMarriage = explode(' ',$dataDetailKartuKeluarga->date_ofMarriage);
            $isi .='                    <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" value="'.$date_ofMarriage[0].'" onfocus="(this.type=`date`)" name="date_ofMarriage" id="date_ofMarriage">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="family_status" id="family_status">
                                                <option value="-"> -- Status Hub Keluarga -- </option>';
                                                $family_status = array("Suami","Istri","Anak","Menantu","Cucu","Orang Tua","Mertua","Famili Lain","Pembantu");
                                                foreach($family_status as $fS){
                                                    if($dataDetailKartuKeluarga->family_status == $fS){
                                                        $isi .='<option value="'.$dataDetailKartuKeluarga->family_status.'" selected>'.$dataDetailKartuKeluarga->family_status.'</option>';
                                                    }
                                                }
                                                $reFS = array_diff($family_status, array($dataDetailKartuKeluarga->family_status));
                                                foreach($reFS as $rFS){
                                                    $isi .='<option value="'.$rFS.'">'.$rFS.'</option>';
                                                }
            $isi .='                        </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="citizenship" id="citizenship" readonly value="WNI">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">';
                                            $paspor= "";
                                            if($dataDetailKartuKeluarga->paspor != ""){
                                                $paspor = $dataDetailKartuKeluarga->paspor;
                                            }else{
                                                $paspor = "-";
                                            }
            $isi .='                        <input type="text" class="form-control" name="paspor" id="paspor" value="'.$paspor.'">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="fatherName" id="fatherName" value="'.$dataDetailKartuKeluarga->fatherName.'">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="motherName" id="motherName" value="'.$dataDetailKartuKeluarga->motherName.'">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <button class="btn btn-primary" id="addDetail" type="button" onclick="updateDetailKartuKeluarga()"> <i class="fas fa-pencil-alt"> </i> Edit Data </button>
                                        </div>
                                    </div>
                                    <div style="width:100%;overflow:auto" id="output-detail"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="table-responsive col-lg-12 float-left" id="data-output">
                            <div class="py-3">
                                <div class="p-3 pt-4 col-lg-12 position-relative float-left" style="border:1px solid black;">
                                <span style="position:absolute;top:-12.5px ;left:15px;background:white;padding:0 8px;"> Detail Kartu Keluarga </span>
                                    <div class="mb-3">
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" required name="NIK" id="NIK" placeholder="NIK">
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" required name="fullName" id="fullName" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="-"> -- Jenis Kelamin -- </option>
                                                <option value="male"> Laki-laki </option>
                                                <option value="female"> Perempuan </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" name="place_ofBirth" id="place_ofBirth" placeholder="Tempat Lahir">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" placeholder="Tanggal Lahir" onfocus="(this.type=`date`)" class="form-control" name="date_ofBirth" id="date_ofBirth">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="religion" id="religion">
                                                <option value="-"> -- Agama -- </option>
                                                <option value="CHRISTIAN"> Kristen </option>
                                                <option value="MUSLIM"> Muslim </option>
                                                <option value="BUDDHA"> Budha </option>
                                                <option value="KONGHUCU"> Konghucu </option>
                                                <option value="CATHOLIC"> Katolik </option>
                                                <option value="HINDU"> Hindu </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="education" id="education">
                                                <option value="-"> -- Pendidikan -- </option>
                                                <option value="Tidak / Belum Sekolah"> Tidak / Belum Sekolah </option>
                                                <option value="Belum Tamat SD / Sederajat"> Belum Tamat SD / Sederajat </option>
                                                <option value="Tamat SD / Sederajat"> Tamat SD / Sederajat </option>
                                                <option value="SLTP / Sederajat"> SLTP / Sederajat </option>
                                                <option value="SLTA / Sederajat"> SLTA / Sederajat </option>
                                                <option value="Diploma I / II"> Diploma I / II </option>
                                                <option value="Akademi/ Diploma III/ S.Muda"> Akademi/ Diploma III/ S.Muda </option>
                                                <option value="Diploma IV / Strata I"> Diploma IV / Strata I </option>
                                                <option value="Strata II"> Strata II </option>
                                                <option value="Strata III"> Strata III </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="job" id="job" placeholder="Pekerjaan">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="blood" id="blood">
                                                <option value="-"> -- Gol Darah -- </option>
                                                <option value="A"> A </option>
                                                <option value="B"> B </option>
                                                <option value="O"> O </option>
                                                <option value="AB"> AB </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="marriage" id="marriage">
                                                <option value="-"> -- Status Perkawinan -- </option>
                                                <option value="Kawin Tercatat"> Kawin Tercatat </option>
                                                <option value="Belum Kawin"> Belum Kawin </option>
                                                <option value="Cerai"> Cerai </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" placeholder="Tanggal Pernikahan" onfocus="(this.type=`date`)" name="date_ofMarriage" id="date_ofMarriage">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="family_status" id="family_status">
                                                <option value="-"> -- Status Hub Keluarga -- </option>
                                                <option value="Suami"> Suami </option>
                                                <option value="Istri"> Istri </option>
                                                <option value="Anak"> Anak </option>
                                                <option value="Menantu"> Menantu </option>
                                                <option value="Cucu"> Cucu </option>
                                                <option value="Orang Tua"> Orang Tua </option>
                                                <option value="Mertua"> Mertua </option>
                                                <option value="Famili Lain"> Famili Lain </option>  
                                                <option value="Pembantu"> Pembantu </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="citizenship" id="citizenship" readonly value="WNI">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="paspor" id="paspor" placeholder="No Paspor">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="fatherName" id="fatherName" placeholder="Nama Ayah">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="motherName" id="motherName" placeholder="Nama Ibu">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <button class="btn btn-primary" id="addDetail" type="button" onclick="tambahDetailKartuKeluarga()"> <i class="fas fa-plus-circle"> </i> Tambah Data </button>
                                        </div>
                                    </div>
                                    <div style="width:100%;overflow:auto" id="output-detail"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
    public function showTempDetailKartuKeluarga($cmd){
        $isi = '';
        if($cmd == "edit"){
            $dateTempDetailKartuKeluarga = tempDetailKartuKeluargaModel::where('NIK',$_POST['NIK'])->first();
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="table-responsive col-lg-12 float-left" id="data-output">
                            <div class="py-3">
                                <div class="p-3 pt-4 col-lg-12 position-relative float-left" style="border:1px solid black;">
                                <span style="position:absolute;top:-12.5px ;left:15px;background:white;padding:0 8px;"> Detail Kartu Keluarga </span>
                                    <div class="mb-3">
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" readonly name="NIK" id="NIK" value="'.$dateTempDetailKartuKeluarga->NIK.'"> 
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" name="fullName" id="fullName" value="'.$dateTempDetailKartuKeluarga->fullName.'">
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="-"> -- Jenis Kelamin -- </option>';
                                                if($dateTempDetailKartuKeluarga->gender == "male"){
                                                    $isi .='
                                                        <option value="'.$dateTempDetailKartuKeluarga->gender.'" selected="selected" > Laki - laki</option>
                                                        <option value="female"> Perempuan </option>';
                                                }else{
                                                    $isi .='
                                                        <option value="male"> Laki-laki </option>
                                                        <option value="'.$dateTempDetailKartuKeluarga->gender.'" selected="selected" > Perempuan </option>';
                                                }
            $isi .='                        </select>
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" name="place_ofBirth" id="place_ofBirth" value="'.$dateTempDetailKartuKeluarga->place_ofBirth.'">
                                        </div>';
                                        $tanggal_lahir = explode(' ',$dateTempDetailKartuKeluarga->date_ofBirth);
            $isi .='                    <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" value="'.$tanggal_lahir[0].'" onfocus="(this.type=`date`)" class="form-control" name="date_ofBirth" id="date_ofBirth">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="religion" id="religion">
                                                <option value="-"> -- Agama -- </option>';    
                                                $religion = array("CHRISTIAN","MUSLIM","BUDDHA","KONGHUCU","CATHOLIC","HINDU");
                                                foreach($religion as $r){
                                                    if($dateTempDetailKartuKeluarga->religion == $r){
                                                        $isi .='<option value="'.$dateTempDetailKartuKeluarga->religion.'" selected>'.$dateTempDetailKartuKeluarga->religion.'</option>';
                                                    }
                                                }
                                                $reR = array_diff($religion, array($dateTempDetailKartuKeluarga->religion));
                                                foreach($reR as $rR){
                                                    $isi .='<option value="'.$rR.'">'.$rR.'</option>';
                                                }
            $isi .='                                                         
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="education" id="education">
                                                <option value="-"> -- Pendidikan -- </option>';
                                                $education = array("Tidak / Belum Sekolah","Belum Tamat SD / Sederajat","Tamat SD / Sederajat","SLTP / Sederajat","SLTA / Sederajat","Diploma I / II","Akademi/ Diploma III/ S.Muda","Diploma IV / Strata I","Strata II","Strata III");
                                                foreach($education as $e){
                                                    if($dateTempDetailKartuKeluarga->education == $e){
                                                        $isi .='<option value="'.$dateTempDetailKartuKeluarga->education.'" selected>'.$dateTempDetailKartuKeluarga->education.'</option>';
                                                    }
                                                }
                                                $reE = array_diff($education, array($dateTempDetailKartuKeluarga->education));
                                                foreach($reE as $rE){
                                                    $isi .='<option value="'.$rE.'">'.$rE.'</option>';
                                                }
            $isi .='                        </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="job" id="job" value="'.$dateTempDetailKartuKeluarga->job.'">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="blood" id="blood">
                                                <option value="-"> -- Gol Darah -- </option>';
                                                $blood = array("A","B","O","AB");
                                                foreach($blood as $b){
                                                    if($dateTempDetailKartuKeluarga->blood == $b){
                                                        $isi .='<option value="'.$dateTempDetailKartuKeluarga->blood.'" selected>'.$dateTempDetailKartuKeluarga->blood.'</option>';
                                                    }
                                                }
                                                $reB = array_diff($blood, array($dateTempDetailKartuKeluarga->blood));
                                                foreach($reB as $rB){
                                                    $isi .='<option value="'.$rB.'">'.$rB.'</option>';
                                                }
            $isi .='                        </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="marriage" id="marriage">
                                                <option value="-"> -- Status Perkawinan -- </option>';
                                                $marriage = array("Kawin Tercatat","Belum Kawin","Cerai");
                                                foreach($marriage as $m){
                                                    if($dateTempDetailKartuKeluarga->marriage == $m){
                                                        $isi .='<option value="'.$dateTempDetailKartuKeluarga->marriage.'" selected>'.$dateTempDetailKartuKeluarga->marriage.'</option>';
                                                    }
                                                }
                                                $reB = array_diff($marriage, array($dateTempDetailKartuKeluarga->marriage));
                                                foreach($reB as $rB){
                                                    $isi .='<option value="'.$rB.'">'.$rB.'</option>';
                                                }
            $isi .='                        </select>
                                        </div>';
                                        $date_ofMarriage = explode(' ',$dateTempDetailKartuKeluarga->date_ofMarriage);
            $isi .='                    <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="date" class="form-control" value="'.$date_ofMarriage[0].'" onfocus="(this.type=`date`)" name="date_ofMarriage" id="date_ofMarriage">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" name="family_status" id="family_status">
                                                <option value="-"> -- Status Hub Keluarga -- </option>';
                                                $family_status = array("Suami","Istri","Anak","Menantu","Cucu","Orang Tua","Mertua","Famili Lain","Pembantu");
                                                foreach($family_status as $fS){
                                                    if($dateTempDetailKartuKeluarga->family_status == $fS){
                                                        $isi .='<option value="'.$dateTempDetailKartuKeluarga->family_status.'" selected>'.$dateTempDetailKartuKeluarga->family_status.'</option>';
                                                    }
                                                }
                                                $reFS = array_diff($family_status, array($dateTempDetailKartuKeluarga->family_status));
                                                foreach($reFS as $rFS){
                                                    $isi .='<option value="'.$rFS.'">'.$rFS.'</option>';
                                                }
            $isi .='                        </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="citizenship" id="citizenship" readonly value="WNI">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">';
                                            $paspor= "";
                                            if($dateTempDetailKartuKeluarga->paspor != ""){
                                                $paspor = $dateTempDetailKartuKeluarga->paspor;
                                            }else{
                                                $paspor = "-";
                                            }
            $isi .='                        <input type="text" class="form-control" name="paspor" id="paspor" value="'.$paspor.'">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="fatherName" id="fatherName" value="'.$dateTempDetailKartuKeluarga->fatherName.'">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="motherName" id="motherName" value="'.$dateTempDetailKartuKeluarga->motherName.'">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <button class="btn btn-primary" id="addDetail" type="button" onclick="updateTempDetailKartuKeluarga()"> <i class="fas fa-pencil-alt"> </i> Edit Data </button>
                                        </div>
                                    </div>
                                    <div style="width:100%;overflow:auto" id="output-detail"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="table-responsive col-lg-12 float-left" id="data-output">
                            <div class="py-3">
                                <div class="p-3 pt-4 col-lg-12 position-relative float-left" style="border:1px solid black;">
                                <span style="position:absolute;top:-12.5px ;left:15px;background:white;padding:0 8px;"> Detail Kartu Keluarga </span>
                                    <div class="mb-3">
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" required name="NIK" id="NIK" placeholder="NIK">
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <input type="text" class="form-control" required name="fullName" id="fullName" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <select class="form-control" required name="gender" id="gender">
                                                <option value="-"> -- Jenis Kelamin -- </option>
                                                <option value="male"> Laki-laki </option>
                                                <option value="female"> Perempuan </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left">
                                            <input type="text" required class="form-control" name="place_ofBirth" id="place_ofBirth" placeholder="Tempat Lahir">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" required placeholder="Tanggal Lahir" onfocus="(this.type=`date`)" class="form-control" name="date_ofBirth" id="date_ofBirth">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" required name="religion" id="religion">
                                                <option value="-"> -- Agama -- </option>
                                                <option value="CHRISTIAN"> Kristen </option>
                                                <option value="MUSLIM"> Muslim </option>
                                                <option value="BUDDHA"> Budha </option>
                                                <option value="KONGHUCU"> Konghucu </option>
                                                <option value="CATHOLIC"> Katolik </option>
                                                <option value="HINDU"> Hindu </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" required name="education" id="education">
                                                <option value="-"> -- Pendidikan -- </option>
                                                <option value="Tidak / Belum Sekolah"> Tidak / Belum Sekolah </option>
                                                <option value="Belum Tamat SD / Sederajat"> Belum Tamat SD / Sederajat </option>
                                                <option value="Tamat SD / Sederajat"> Tamat SD / Sederajat </option>
                                                <option value="SLTP / Sederajat"> SLTP / Sederajat </option>
                                                <option value="SLTA / Sederajat"> SLTA / Sederajat </option>
                                                <option value="Diploma I / II"> Diploma I / II </option>
                                                <option value="Akademi/ Diploma III/ S.Muda"> Akademi/ Diploma III/ S.Muda </option>
                                                <option value="Diploma IV / Strata I"> Diploma IV / Strata I </option>
                                                <option value="Strata II"> Strata II </option>
                                                <option value="Strata III"> Strata III </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" required class="form-control" name="job" id="job" placeholder="Pekerjaan">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" required name="blood" id="blood">
                                                <option value="-"> -- Gol Darah -- </option>
                                                <option value="A"> A </option>
                                                <option value="B"> B </option>
                                                <option value="O"> O </option>
                                                <option value="AB"> AB </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" required name="marriage" id="marriage">
                                                <option value="-"> -- Status Perkawinan -- </option>
                                                <option value="Kawin Tercatat"> Kawin Tercatat </option>
                                                <option value="Belum Kawin"> Belum Kawin </option>
                                                <option value="Cerai"> Cerai </option>

                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" placeholder="Tanggal Pernikahan" onfocus="(this.type=`date`)" name="date_ofMarriage" id="date_ofMarriage">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <select class="form-control" required name="family_status" id="family_status">
                                                <option value="-"> -- Status Hub Keluarga -- </option>
                                                <option value="Suami"> Suami </option>
                                                <option value="Istri"> Istri </option>
                                                <option value="Anak"> Anak </option>
                                                <option value="Menantu"> Menantu </option>
                                                <option value="Cucu"> Cucu </option>
                                                <option value="Orang Tua"> Orang Tua </option>
                                                <option value="Mertua"> Mertua </option>
                                                <option value="Famili Lain"> Famili Lain </option>  
                                                <option value="Pembantu"> Pembantu </option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="citizenship" id="citizenship" readonly value="WNI">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" class="form-control" name="paspor" id="paspor" placeholder="No Paspor">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" required class="form-control" name="fatherName" id="fatherName" placeholder="Nama Ayah">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <input type="text" required class="form-control" name="motherName" id="motherName" placeholder="Nama Ibu">
                                        </div>
                                        <div class="col-lg-3 float-left" style="margin-top:10px">
                                            <button class="btn btn-primary" id="addDetail" type="button" onclick="tambahDetailKartuKeluarga()"> <i class="fas fa-plus-circle"> </i> Tambah Data </button>
                                        </div>
                                    </div>
                                    <div style="width:100%;overflow:auto" id="output-detail"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
