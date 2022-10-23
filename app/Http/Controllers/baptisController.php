<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dataBaptisModel;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class baptisController extends Controller
{
    public function readBaptis(Request $request){
        $baptis = dataBaptisModel::get();
        $row = $baptis->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $baptis = array_slice($baptis->toArray(),$starting_point,$per_page,true);
        $baptis= new LengthAwarePaginator($baptis, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'baptis' => $baptis
        ];
        return view('DataJemaat.Baptis.index',$data);
    }
    public function getAllBaptis(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataBaptis = dataBaptisModel::orderByRaw("SUBSTRING_INDEX(baptism_id, '/', -1) + 0 DESC")->get();
        $count = count($dataBaptis);
        $currentItems = $dataBaptis->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';
        if(count($dataBaptis) <= 0){
            $isi .='
                <tr>
                    <th colspan="7"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($paginator as $dB){
                $pisahTTL = explode(' ',$dB->date_ofBirth);
                $pisahTB = explode(' ',$dB->date_ofBaptism);
                $tanggal_baruTTL = explode('-',$pisahTTL[0]);
                $tanggal_baruTB = explode('-',$pisahTB[0]);
                $isi .='
                    <tr>
                        <td>'.$dB->baptism_id.'</td>
                        <td>'.$dB->full_name.'</td>
                        <td>'.$dB->place_ofBirth.', '.$tanggal_baruTTL[2].'-'.$tanggal_baruTTL[1].'-'.$tanggal_baruTTL[0].'</td>
                        <td>'.$tanggal_baruTB[2].'-'.$tanggal_baruTB[1].'-'.$tanggal_baruTB[0].'</td>
                        <td>'.$dB->pastor.'</td>';
                        if($dB->gender == "female"){
                            $isi .='<td> Perempuan </td>';
                        }else{
                            $isi .='<td> Laki-laki </td>';
                        }
                $isi .='
                        <td>
                            <button onclick="editBaptisModal(`'.$dB->baptism_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteBaptis(`'.$dB->baptism_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function createBaptis(Request $request){
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$request->baptism_id);
        if($request->hasFile('photo')){
            $photoName = $row[3].".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('BAPTIS')->putFileAs('Baptis',$request->file('photo'),$photoName.'.'.$extPhotoFile);
        }else{
            $urlPhotoFile = "";
        }

        dataBaptisModel::create([
            'baptism_id' => $request->baptism_id,
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'place_ofBirth' => $request->place_ofBirth,
            'date_ofBirth' => $request->date_ofBirth,
            'date_ofBaptism' => $request->date_ofBaptism,
            'church' => 'SION WKO',
            'religion' => 'Christian',
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,
            'pastor' => $request->pastor,
            'photo' => $urlPhotoFile
        ]);
        return redirect('/adm/dataJemaat/baptis')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function updateBaptis(Request $request){
        $dataBaptisByID = dataBaptisModel::where('baptism_id',$_POST['baptism_id'])->first();

        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$request->baptism_id);
        if($request->hasFile('photo')){
            $photoName = $row[3].".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('BAPTIS')->putFileAs('Baptis',$request->file('photo'),$photoName.'.'.$extPhotoFile);
        }else{
            $urlPhotoFile = $dataBaptisByID->photo;
        }

        dataBaptisModel::where('baptism_id',$request->baptism_id)->update([
            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'place_ofBirth' => $request->place_ofBirth,
            'date_ofBirth' => $request->date_ofBirth,
            'date_ofBaptism' => $request->date_ofBaptism,
            'church' => 'SION WKO',
            'religion' => 'Christian',
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'address' => $request->address,
            'pastor' => $request->pastor,
            'photo' => $urlPhotoFile
        ]);
        return redirect('/adm/dataJemaat/baptis')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteBaptis(){
        try{
            dataBaptisModel::where('baptism_id',$_POST['baptism_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showBaptisModel(){
        $dataBaptis = dataBaptisModel::orderByRaw("SUBSTRING_INDEX(baptism_id, '/', -1) + 0 ASC")->get();
        $row = $dataBaptis->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_baptis = $dataBaptis[$row-1]->baptism_id;
            $pisah = explode('/',$id_baptis);
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
                                <label for="baptism_id"> ID Baptis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="baptism_id" name="baptism_id" value="'."BPTS/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="photo"> Foto </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" class="form-control" id="photo" name="photo" >
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
                                    <input type="text" class="form-control" required id="full_name" name="full_name" placeholder="Masukan Nama Lengkap">
                                </div>
                            </div>
                        </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sermon_date"> Jenis Kelamin </label>
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
                                <label for="place_ofBirth"> Tempat Lahir</label>
                            </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="place_ofBirth" name="place_ofBirth" placeholder="Masukan Tempat Lahir">
                                </div>
                            </div>
                        </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date_ofBirth"> Tanggal Lahir </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" class="form-control" required id="date_ofBirth" name="date_ofBirth" >     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="address"> Alamat</label>
                            </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="address" name="address" placeholder="Masukan Alamat">
                                </div>
                            </div>
                        </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date_ofBaptism"> Tanggal Baptis</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" class="form-control" required id="date_ofBaptism" name="date_ofBaptism" placeholder="Masukan Tanggal Lahir">     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="father_name"> Nama Ayah</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="father_name" name="father_name" placeholder="Masukan Nama Ayah">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="mother_name"> Nama Ibu </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="mother_name" name="mother_name" placeholder="Masukan Nama Ibu">     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="pastor"> Pendeta Pembaptis</label>
                            </div>
                            <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="pastor" name="pastor" placeholder="Masukan Nama Pendeta">
                            </div>
                        </div>
                    </div>
                </div>';
        }
        else{
            $baptisModel = dataBaptisModel::where('baptism_id',$_POST['baptism_id'])->first();
            $isi .=' 
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="baptism_id"> ID Baptis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="baptism_id" name="baptism_id" value="'.$baptisModel->baptism_id.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="photo"> Foto </label>
                            </div>
                            <div class="col-xl-3">
                                <input type="file" class="form-control" id="photo" name="photo" >
                            </div>
                            <div class="col-xl-5">';
                                if($baptisModel->photo == NULL){
                                    $isi .='<img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:150px;width:200px;">';
                                }else{
                                    $isi .='<img src="'.asset('/uploads/BAPTIS/'.$baptisModel->photo).'" style="height:150px;width:200px;">';
                                }
                $isi .='    </div>
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
                                    <input type="text" class="form-control" required id="full_name" name="full_name" value="'.$baptisModel->full_name.'">
                                </div>
                            </div>
                        </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sermon_date"> Jenis Kelamin </label>
                            </div>
                            <div class="col-xl-8">';
                                if($baptisModel->gender == "male"){
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
                                <label for="place_ofBirth"> Tempat Lahir</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="place_ofBirth" name="place_ofBirth" value="'.$baptisModel->place_ofBirth.'">
                                </div>
                            </div>
                        </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date_ofBirth"> Tanggal Lahir </label>
                            </div>';
                            $date_ofBirth = explode(' ',$baptisModel->date_ofBirth);
                $isi .='    <div class="col-xl-8">
                                <input type="date" class="form-control" required id="date_ofBirth" name="date_ofBirth" value="'.$date_ofBirth[0].'">     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="address"> Alamat</label>
                            </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="address" name="address" value="'.$baptisModel->address.'">
                                </div>
                            </div>
                        </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date_ofBaptism"> Tanggal Baptis</label>
                            </div>';
                            $date_ofBaptism = explode(' ',$baptisModel->date_ofBaptism);
                $isi .='    <div class="col-xl-8">
                                <input type="date" class="form-control" required id="date_ofBaptism" name="date_ofBaptism" value="'.$date_ofBaptism[0].'">     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="father_name"> Nama Ayah</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="father_name" name="father_name" value="'.$baptisModel->father_name.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="mother_name"> Nama Ibu </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="mother_name" name="mother_name" value="'.$baptisModel->mother_name.'">     
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="pastor"> Pendeta Pembaptis</label>
                            </div>
                            <div class="col-xl-8">
                            <input type="text" class="form-control" required id="pastor" name="pastor" value="'.$baptisModel->pastor.'">
                            </div>
                        </div>
                    </div>
                </div>';
        }
        return $isi;
    }
}