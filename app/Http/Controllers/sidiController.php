<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataSIDIModel;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class sidiController extends Controller
{
    public function readSIDI(Request $request){
        $sidi = dataSIDIModel::get();
        $row = $sidi->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $sidi = array_slice($sidi->toArray(),$starting_point,$per_page,true);
        $sidi= new LengthAwarePaginator($sidi, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'sidi' => $sidi
        ];
        return view('DataJemaat.SIDI.index',$data);
    }
    public function createSIDI(Request $request){
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$request->sidi_id);

        if($request->hasFile('baptism_file')){
            $baptismFileName = $row[3].".".$split[0].".".$split[1].".";
            $extBaptismFile = $request->file('baptism_file')->extension();
            $urlBaptismFile = Storage::disk('SIDI')->putFileAs('Baptis',$request->file('baptism_file'),$baptismFileName.'.'.$extBaptismFile);
        }else{
            $urlBaptismFile = "";
        }
        if($request->hasFile('marriage_certificate')){
            $marriageFileName = $row[3].".".$split[0].".".$split[1].".";
            $extMarriageCertificate = $request->file('marriage_certificate')->extension();
            $urlMarriageCertificate = Storage::disk('SIDI')->putFileAs('Pernikahan',$request->file('marriage_certificate'),$marriageFileName.'.'.$extMarriageCertificate);
        }
        else{
            $urlMarriageCertificate = "";
        }
        if($request->hasFile('photo')){
            $photoFileName = $row[3].".".$split[0].".".$split[1].".";
            $extPhoto = $request->file('photo')->extension();
            $urlPhoto = Storage::disk('SIDI')->putFileAs('Photo',$request->file('photo'),$photoFileName.'.'.$extPhoto);
        }
        else{
            $urlPhoto = "";
        }
        dataSIDIModel::create([
            'sidi_id' => $request->sidi_id,
            'familyCard_id' => $request->familyCard_id,
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'place_ofBirth' => $request->place_ofBirth,
            'date_ofBirth' => $request->date_ofBirth,
            'date_ofSIDI' => $request->date_ofSIDI,
            'NIK' => $request->NIK,
            'baptism_file' => $urlBaptismFile,
            'date_ofBaptism' => $request->date_ofBaptism,
            'church' => $request->church,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,
            'marriage_certificate' => $urlMarriageCertificate,
            'photo' => $urlPhoto,
            'phone_number' => $request->phone_number,
        ]);
        return redirect('/adm/dataJemaat/sidi')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteSIDI(){
        try{
            $ibadah = dataSIDIModel::where('sidi_id',$_POST['sidi_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function getAllSIDI(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataSIDI = dataSIDIModel::orderByRaw("SUBSTRING_INDEX(sidi_id, '/', -1) + 0 DESC")->get();
        $count = count($dataSIDI);
        $currentItems = $dataSIDI->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';
        if(count($dataSIDI) <= 0){
            $isi .='
                <tr>
                    <th colspan="9"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($paginator as $dS){
                $pisah = explode(' ',$dS->date_ofBirth);
                $tanggal_baru = explode('-',$pisah[0]);
                $isi .='
                    <tr>
                        <td>'.$dS->sidi_id.'</td>
                        <td>'.$dS->NIK.'</td>
                        <td>'.$dS->full_name.'</td>
                        <td>'.$dS->place_ofBirth.', '.$tanggal_baru[2].'-'.$tanggal_baru[1].'-'.$tanggal_baru[0].'</td>';
                        if($dS->familyCard_id == ""){
                            $isi .='<td> - </td>';
                        }else{
                            $isi .='<td>'.$dS->familyCard_id.'</td>';
                        }
                        if($dS->baptism_file == NULL){
                            $isi .='<td> <i class="fas fa-times-circle"></i> </td>';
                        }else{
                            $isi .='<td> <i class="fas fa-check-circle"></i> </td>';
                        }
                        if($dS->marriage_certificate == NULL){
                            $isi .='<td> <i class="fas fa-times-circle"></i> </td>';
                        }else{
                            $isi .='<td> <i class="fas fa-check-circle"></i> </td>';
                        }
                        if($dS->photo == NULL){
                            $isi .='<td> <i class="fas fa-times-circle"></i> </td>';
                        }else{
                            $isi .='<td> <i class="fas fa-check-circle"></i> </td>';
                        }
                $isi .='
                        <td> 
                            <button onclick="editSIDIModal(`'.$dS->sidi_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteSIDI(`'.$dS->sidi_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function showSIDIModel(){
        $dataSIDI = dataSIDIModel::orderByRaw("SUBSTRING_INDEX(sidi_id, '/', -1) + 0 ASC")->get();
        $row = $dataSIDI->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_sidi = $dataSIDI[$row-1]->sidi_id;
            $pisah = explode('/',$id_sidi);
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
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sidi_id">ID SIDI </label>
                            </div>
                            <div class="col-xl-4">
                                <input type="text" class="form-control" readonly id="sidi_id" name="sidi_id" value="'."SIDI/".$bulan."/".$tahun."/".$row.'">
                            </div>
                            <div class="col-xl-4">
                                <input type="text" class="form-control" required id="familyCard_id" name="familyCard_id" placeholder="No KK">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="NIK"> NIK </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="NIK" name="NIK" placeholder="NIK">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="full_name"> Nama Lengkap </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="full_name" name="full_name" placeholder="Nama Lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="place_ofBirth"> Tempat Lahir </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="place_ofBirth" name="place_ofBirth" placeholder="Tempat Lahir">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date_ofBirth"> Tanggal Lahir </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" class="form-control" required id="date_ofBirth" name="date_ofBirth">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="created_at"> Tanggal SIDI </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" required class="form-control" name="date_ofSIDI" id="date_ofSIDI">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date_ofBaptism"> Tanggal Baptis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" class="form-control" required id="date_ofBaptism" name="date_ofBaptism">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="gender"> Jenis Kelamin </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="radio" required id="gender" name="gender" value="male"> Laki-laki
                                <input type="radio" required id="gender" name="gender" value="female"> Perempuan  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="phone_number"> No HP </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="phone_number" name="phone_number" placeholder="No HP">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="church"> Gereja </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="church" name="church" placeholder="Gereja">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="father_name"> Nama Ayah </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="father_name" name="father_name" placeholder="Nama Ayah">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="mother_name"> Nama Ibu </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="mother_name" name="mother_name" placeholder="Nama Ibu">
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
                                <input type="text" class="form-control" required id="address" name="address" placeholder="Alamat">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="marriage_certificate"> Sertifikat Pernikahan </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" class="form-control" id="marriage_certificate" name="marriage_certificate" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="photo"> Foto </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="baptism_file"> File Baptis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" class="form-control" id="baptism_file" name="baptism_file" placeholder="File Baptis">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $sidiModel = dataSIDIModel::where('sidi_id',$_POST['sidi_id'])->first();
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sidi_id">ID SIDI </label>
                            </div>
                            <div class="col-xl-4">
                                <input type="text" class="form-control" readonly id="sidi_id" name="sidi_id" value="'.$sidiModel->sidi_id.'">
                            </div>
                            <div class="col-xl-4">
                                <input type="text" class="form-control" id="familyCard_id" name="familyCard_id" value="'.$sidiModel->familyCard_id.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="NIK"> NIK </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="NIK" name="NIK" value="'.$sidiModel->NIK.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="full_name"> Nama Lengkap </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="full_name" name="full_name" value="'.$sidiModel->full_name.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="place_ofBirth"> Tempat Lahir </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="place_ofBirth" name="place_ofBirth" value="'.$sidiModel->place_ofBirth.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date_ofBirth"> Tanggal Lahir </label>
                            </div>';
                            $date_ofBirth = explode(' ',$sidiModel->date_ofBirth);
                $isi .='
                            <div class="col-xl-8">
                                <input type="date" class="form-control" required id="date_ofBirth" name="date_ofBirth" value="'.$date_ofBirth[0].'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date_ofSIDI"> Tanggal SIDI </label>
                            </div>';
                            $date_ofSIDI = explode(' ',$sidiModel->date_ofSIDI);
                $isi .='
                            <div class="col-xl-8">
                                <input type="date" required class="form-control" name="date_ofSIDI" id="date_ofSIDI" value="'.$date_ofSIDI[0].'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date_ofBaptism"> Tanggal Baptis </label>
                            </div>';
                            $date_ofBaptism = explode(' ',$sidiModel->date_ofBaptism);
                $isi .='
                            <div class="col-xl-8">
                                <input type="date" class="form-control" required id="date_ofBaptism" name="date_ofBaptism" value="'.$date_ofBaptism[0].'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="gender"> Jenis Kelamin </label>
                            </div>
                            <div class="col-xl-8">';
                            if($sidiModel->gender == "male"){
                                $isi .='
                                    <input type="radio" required id="gender" name="gender" checked value="male"> Laki-laki
                                    <input type="radio" required id="gender" name="gender" value="female"> Perempuan  
                                ';
                            }else{
                                $isi .='
                                    <input type="radio" required id="gender" name="gender" value="male"> Laki-laki
                                    <input type="radio" required id="gender" name="gender" checked value="female"> Perempuan  
                                ';
                            }
                $isi .='    </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="phone_number"> No HP </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="phone_number" name="phone_number" value="'.$sidiModel->phone_number.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="church"> Gereja </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="church" name="church" value="'.$sidiModel->church.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="father_name"> Nama Ayah </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="father_name" name="father_name" value="'.$sidiModel->father_name.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="mother_name"> Nama Ibu </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="mother_name" name="mother_name" value="'.$sidiModel->mother_name.'">
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
                                <input type="text" class="form-control" required id="address" name="address" value="'.$sidiModel->address.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="marriage_certificate"> Sertifikat Pernikahan </label>
                            </div>
                            <div class="col-xl-3">
                                <input type="file" class="form-control" id="marriage_certificate" name="marriage_certificate" >
                            </div>
                            <div class="col-xl-5">';
                                if($sidiModel->marriage_certificate == NULL){
                                    $isi .='<img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:150px;width:200px;cursor:pointer;">';
                                }else{
                                    $isi .='<img src="'.asset('/uploads/SIDI/'.$sidiModel->marriage_certificate).'" style="height:150px;width:200px;cursor:pointer;">';
                                }
                $isi .='    </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="photo"> Foto </label>
                            </div>
                            <div class="col-xl-3">
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                            <div class="col-xl-5">';
                                if($sidiModel->photo == NULL){
                                    $isi .='<img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:150px;width:200px;">';
                                }else{
                                    $isi .='<img src="'.asset('/uploads/SIDI/'.$sidiModel->photo).'" style="height:150px;width:200px;">';
                                }
                $isi .='    </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="baptism_file"> File Baptis </label>
                            </div>
                            <div class="col-xl-3">
                                <input type="file" class="form-control" id="baptism_file" name="baptism_file" placeholder="File Baptis">
                            </div>
                            <div class="col-xl-5">';
                                if($sidiModel->baptism_file == NULL){
                                    $isi .='<img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:150px;width:200px;">';
                                }else{
                                    $isi .='<img src="'.asset('/uploads/SIDI/'.$sidiModel->baptism_file).'" style="height:150px;width:200px;">';
                                }
                $isi .='    </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
    public function updateSIDI(Request $request){
        $dataSIDIByID = dataSIDIModel::where('sidi_id',$request->sidi_id)->first();
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$request->sidi_id);

        if($request->hasFile('baptism_file')){
            $baptismFileName = $row[3].".".$split[0].".".$split[1].".";
            $extBaptismFile = $request->file('baptism_file')->extension();
            $urlBaptismFile = Storage::disk('SIDI')->putFileAs('Baptis',$request->file('baptism_file'),$baptismFileName.'.'.$extBaptismFile);
        }else{
            $urlBaptismFile = $dataSIDIByID->baptism_file;
        }
        if($request->hasFile('marriage_certificate')){
            $marriageFileName = $row[3].".".$split[0].".".$split[1].".";
            $extMarriageCertificate = $request->file('marriage_certificate')->extension();
            $urlMarriageCertificate = Storage::disk('SIDI')->putFileAs('Pernikahan',$request->file('marriage_certificate'),$marriageFileName.'.'.$extMarriageCertificate);
        }
        else{
            $urlMarriageCertificate = $dataSIDIByID->marriage_certificate;
        }
        if($request->hasFile('photo')){
            $photoFileName = $row[3].".".$split[0].".".$split[1].".";
            $extPhoto = $request->file('photo')->extension();
            $urlPhoto = Storage::disk('SIDI')->putFileAs('Photo',$request->file('photo'),$photoFileName.'.'.$extPhoto);
        }
        else{
            $urlPhoto = $dataSIDIByID->photo;
        }
        dataSIDIModel::where('sidi_id',$request->sidi_id)->update([
            'familyCard_id' => $request->familyCard_id,
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'place_ofBirth' => $request->place_ofBirth,
            'date_ofBirth' => $request->date_ofBirth,
            'date_ofSIDI' => $request->date_ofSIDI,
            'NIK' => $request->NIK,
            'baptism_file' => $urlBaptismFile,
            'date_ofBaptism' => $request->date_ofBaptism,
            'church' => $request->church,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,
            'marriage_certificate' => $urlMarriageCertificate,
            'photo' => $urlPhoto,
            'phone_number' => $request->phone_number,
        ]);
        return redirect('/adm/dataJemaat/sidi')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
}
