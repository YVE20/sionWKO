<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\majelisIbadahMingguModel;
use App\Models\kategoriPelayananModel;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class majelisIbadahMingguController extends Controller
{
    public function readMajelisIbadahMinggu(Request $request){
        $majelisIbadahMinggu = majelisIbadahMingguModel::get();
        $row = $majelisIbadahMinggu->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $majelisIbadahMinggu = array_slice($majelisIbadahMinggu->toArray(),$starting_point,$per_page,true);
        $majelisIbadahMinggu= new LengthAwarePaginator($majelisIbadahMinggu, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'majelisIbadahMinggu' => $majelisIbadahMinggu
        ];
        return view('Pelayan.Pembagian Tugas.Majelis Ibadah Minggu.index',$data);
    }
    public function createMajelisIbadahMinggu(Request $request){
        $serviceCategory_id = "MIM/2022";
        majelisIbadahMingguModel::create([
            'assembly_id' => $request->assembly_id,
            'serviceCategory_id' => $serviceCategory_id,
            'assembly' => $request->assembly,
            'coordinator' => $request->coordinator,
            'khadim_companion' => $request->khadim_companion,
            'uniform' => $request->uniform,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/majelisIbadahMinggu')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function getAllMajelisIbadahMinggu(){
        $chooseMajelisIbadahMinggu = $_POST['chooseMajelisIbadahMinggu'] == "-" ? "" : $_POST['chooseMajelisIbadahMinggu'];
        $dataMajelisIbadahMinggu = new majelisIbadahMingguModel();
        if($chooseMajelisIbadahMinggu != ""){
            $dataMajelisIbadahMinggu = $dataMajelisIbadahMinggu->where('assembly',$chooseMajelisIbadahMinggu);
        }
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataMajelisIbadahMinggu = $dataMajelisIbadahMinggu->orderByRaw("SUBSTRING_INDEX(assembly_id, '/', -1) + 0 DESC")->get();
        $count = count($dataMajelisIbadahMinggu);
        $currentItems = $dataMajelisIbadahMinggu->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataMajelisIbadahMinggu) <= 0){
            $isi .='
                <tr>
                    <th colspan="8"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            $row = 1;
            foreach($paginator as $dMIM){
                $pisah = explode(' ',$dMIM->sermon_date);
                $tanggal = explode('-',$pisah[0]);
                $jam = explode(':',$dMIM->time);
                $isi .='
                    <tr>
                        <td>'.$row++.'</td>
                        <td>'.$dMIM->assembly_id.'</td>
                        <td>'.$dMIM->assembly.'</td>
                        <td>'.$dMIM->coordinator.'</td>
                        <td>'.$dMIM->khadim_companion.'</td>
                        <td>'.$dMIM->uniform.'</td>
                        <td>'.$tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' || '.$jam[0].':'.$jam[1].'</td>
                        <td>
                            <button onclick="editMajelisIbadahMingguModal(`'.$dMIM->assembly_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteMajelisIbadahMinggu(`'.$dMIM->assembly_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                    ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function updateMajelisIbadahMinggu(Request $request){
        majelisIbadahMingguModel::where('assembly_id',$request->assembly_id)->update([
            'serviceCategory_id' => "",
            'assembly' => $request->assembly,
            'coordinator' => $request->coordinator,
            'khadim_companion' => $request->khadim_companion,
            'uniform' => $request->uniform,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/majelisIbadahMinggu')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteMajelisIbadahMinggu(){
        try{
            majelisIbadahMingguModel::where('assembly_id',$_POST['assembly_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showMajelisIbadahMingguModel(Request $request){
        $dataMajelisIbadahMinggu = majelisIbadahMingguModel::orderByRaw("SUBSTRING_INDEX(assembly_id, '/', -1) + 0 ASC")->get();
        $row = $dataMajelisIbadahMinggu->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_majelis_ibadah_minggu = $dataMajelisIbadahMinggu[$row-1]->assembly_id;
            $pisah = explode('/',$id_majelis_ibadah_minggu);
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
                                <label for="assembly_id">ID Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="assembly_id" name="assembly_id" value="'."SER/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="assembly"> Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" autofocus required id="assembly" name="assembly">
                                    <option value="-"> -- PILIH -- </option>
                                    <option value="Kelompok 1"> Kelompok 1 </option>
                                    <option value="Kelompok 2"> Kelompok 2 </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="coordinator"> Koordinator </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="coordinator" name="coordinator" placeholder="Koordinator">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="khadim_companion"> Pendamping Khadim </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="khadim_companion" name="khadim_companion" placeholder="Pendamping Khadim">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="uniform"> Seragam </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="uniform" name="uniform" placeholder="Seragam">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sermon_date"> Tanggal & Waktu </label>
                            </div>
                            <div class="col-xl-5">
                                <input type="date" class="form-control" required id="sermon_date" name="sermon_date" placeholder="Seragam">
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" required id="time" name="time" placeholder="Seragam">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $dataMajelisIbadahMingguModel = majelisIbadahMingguModel::where('assembly_id',$_POST['assembly_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="assembly_id">ID Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="assembly_id" name="assembly_id" value="'.$dataMajelisIbadahMingguModel[0]->assembly_id.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="assembly"> Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" id="assembly" name="assembly">
                                    <option> -- PILIH -- </option>';
                                        if($dataMajelisIbadahMingguModel[0]->assembly == "Kelompok 1"){
                                            $isi .='
                                                <option value="Kelompok 1" selected> Kelompok 1 </option>
                                                <option value="Kelompok 2"> Kelompok 2 </option> 
                                            ';
                                        }else{
                                            $isi .='
                                                <option value="Kelompok 1"> Kelompok 1 </option>
                                                <option value="Kelompok 2" selected> Kelompok 2 </option>  
                                            ';
                                        }
        $isi .='                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="coordinator"> Koordinator </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="coordinator" name="coordinator" value="'.$dataMajelisIbadahMingguModel[0]->coordinator.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="khadim_companion"> Pendamping Khadim </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="khadim_companion" name="khadim_companion" value="'.$dataMajelisIbadahMingguModel[0]->khadim_companion.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="uniform"> Seragam </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="uniform" name="uniform" value="'.$dataMajelisIbadahMingguModel[0]->uniform.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sermon_date"> Tanggal & Waktu </label>
                            </div>
                            <div class="col-xl-5">';
                            $tanggal = explode(' ',$dataMajelisIbadahMingguModel[0]->sermon_date);
            $isi .='            <input type="date" class="form-control" id="sermon_date" name="sermon_date" value="'.$tanggal[0].'" >
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" id="time" name="time" value="'.$dataMajelisIbadahMingguModel[0]->time.'">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
