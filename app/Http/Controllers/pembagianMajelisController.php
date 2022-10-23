<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pembagianMajelisModel;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class pembagianMajelisController extends Controller
{
    public function readPembagianMajelis(Request $request){
        $pembagianMajelis = pembagianMajelisModel::get();
        $row = $pembagianMajelis->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $pembagianMajelis = array_slice($pembagianMajelis->toArray(),$starting_point,$per_page,true);
        $pembagianMajelis= new LengthAwarePaginator($pembagianMajelis, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'pembagianMajelis' => $pembagianMajelis
        ];
        return view('Pelayan.Pembagian Majelis.index',$data);
    }
    public function createPembagianMajelis(Request $request){
        pembagianMajelisModel::create([
            'assemblyData_id' => $request->assemblyData_id,
            'assembly_group' => $request->assembly_group,
            'assembly_name' => $request->assembly_name,
            'sermon_date' => $request->sermon_date
        ]);
        return redirect('/adm/pelayanan/pembagianMajelis')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function getAllPembagianMajelis(){
        $searchPembagianMajelis = $_POST['searchPembagianMajelis'] ? $_POST['searchPembagianMajelis'] : "";
        $choosePembagianMajelis = $_POST['choosePembagianMajelis'] ? $_POST['choosePembagianMajelis'] : "";
        $dataPembagianMajelis = new pembagianMajelisModel();
        if($searchPembagianMajelis != ""){
            $dataPembagianMajelis = $dataPembagianMajelis->where('assembly_name','like','%'.$searchPembagianMajelis.'%');
        }
        if($choosePembagianMajelis != ""){
            $dataPembagianMajelis = $dataPembagianMajelis->where('assembly_group',$choosePembagianMajelis);
        }
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataPembagianMajelis = $dataPembagianMajelis->orderByRaw("SUBSTRING_INDEX(assemblyData_id, '/', -1) + 0 DESC")->get();
        $count = count($dataPembagianMajelis);
        $currentItems = $dataPembagianMajelis->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataPembagianMajelis) <= 0){
            $isi .='
                <tr>
                    <th colspan="6"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            $row = 1;
            foreach($paginator as $dMIM){
                $tanggal = explode('-',$dMIM->sermon_date);
                $isi .='
                    <tr>
                        <td>'.$row++.'</td>
                        <td>'.$dMIM->assemblyData_id.'</td>
                        <td>'.$dMIM->assembly_name.'</td>
                        <td>'.$dMIM->assembly_group.'</td>
                        <td>'.($tanggal[2]).'-'.($tanggal[1]).'-'.($tanggal[0]).'</td>
                        <td>
                            <button onclick="editPembagianMajelisModal(`'.$dMIM->assemblyData_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deletePembagianMajelis(`'.$dMIM->assemblyData_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                    ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function updatePembagianMajelis(Request $request){
        pembagianMajelisModel::where('assemblyData_id',$request->assemblyData_id)->update([
            'assembly_group' => $request->assembly_group,
            'assembly_name' => $request->assembly_name,
            'sermon_date' => $request->sermon_date
        ]);
        return redirect('/adm/pelayanan/pembagianMajelis')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deletePembagianMajelis(){
        try{
            pembagianMajelisModel::where('assemblyData_id',$_POST['assemblyData_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showPembagianMajelisModel(Request $request){
        $dataPembagianMajelis = pembagianMajelisModel::orderByRaw("SUBSTRING_INDEX(assemblyData_id, '/', -1) + 0 ASC")->get();
        $row = $dataPembagianMajelis->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_PembagianMajelis = $dataPembagianMajelis[$row-1]->assemblyData_id;
            $pisah = explode('/',$id_PembagianMajelis);
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
                                <label for="assemblyData_id"> ID Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="assemblyData_id" name="assemblyData_id" value="'."MJLS/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="assembly_name"> Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="assembly_name" name="assembly_name" placeholder="Majelis">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="assembly_group"> Kelompok Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" required id="assembly_group" name="assembly_group">
                                    <option value="-"> -- PILIH -- </option>
                                    <option value="Kelompok 1"> Kelompok 1 </option>
                                    <option value="Kelompok 2"> Kelompok 2 </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sermon_date"> Tanggal Ibadah </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" class="form-control" id="sermon_date" name="sermon_date" >
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $dataPembagianMajelisModel = pembagianMajelisModel::where('assemblyData_id',$_POST['assemblyData_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="assemblyData_id"> ID Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="assemblyData_id" name="assemblyData_id" value="'.$dataPembagianMajelisModel[0]->assemblyData_id.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="assembly_name"> Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="assembly_name" name="assembly_name" value="'.$dataPembagianMajelisModel[0]->assembly_name.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="assembly_group"> Kelompok Majelis </label>
                            </div>
                            <div class="col-xl-8">
                                <select class="form-control" required id="assembly_group" name="assembly_group">
                                    <option value="-"> -- PILIH -- </option>';
                                    if($dataPembagianMajelisModel[0]->assembly_group == "Kelompok 1"){
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
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sermon_date"> Tanggal Ibadah </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="date" class="form-control" id="sermon_date" name="sermon_date" value="'.$dataPembagianMajelisModel[0]->sermon_date.'">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
