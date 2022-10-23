<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\khadimModel;
use App\Models\kategoriPelayananModel;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class khadimController extends Controller
{
    public function readKhadim(Request $request){
        $khadim = khadimModel::get();
        $row = $khadim->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $khadim = array_slice($khadim->toArray(),$starting_point,$per_page,true);
        $khadim= new LengthAwarePaginator($khadim, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'khadim' => $khadim
        ];
        return view('Pelayan.Pembagian Tugas.Khadim.index',$data);
    }
    public function createKhadim(Request $request){
        $serviceCategory_id = "KHDM/2022";
        khadimModel::create([
            'khadim_id' => $request->khadim_id,
            'serviceCategory_id' => $serviceCategory_id,
            'theme' => $request->theme,
            'khadim' => $request->khadim,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/khadim')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function getAllKhadim(){
        $searchKhadim = $_POST['searchKhadim'] ? $_POST['searchKhadim'] : "";
        $dataKhadim = new khadimModel();
        if($searchKhadim != ""){
            $dataKhadim = $dataKhadim->where('khadim','like','%'.$searchKhadim.'%');
        }
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataKhadim = $dataKhadim->orderByRaw("SUBSTRING_INDEX(khadim_id, '/', -1) + 0 DESC")->get();
        $count = count($dataKhadim);
        $currentItems = $dataKhadim->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataKhadim) <= 0){
            $isi .='
                <tr>
                    <th colspan="6"> <center> TIDAK ADA DATA </center> </th>
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
                        <td>'.$dMIM->khadim_id.'</td>
                        <td>'.$dMIM->theme.'</td>
                        <td>'.$dMIM->khadim.'</td>
                        <td>'.$tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' || '.$jam[0].':'.$jam[1].'</td>
                        <td>
                            <button onclick="editKhadimModal(`'.$dMIM->khadim_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteKhadim(`'.$dMIM->khadim_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                    ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function updateKhadim(Request $request){
        khadimModel::where('khadim_id',$request->khadim_id)->update([
            'serviceCategory_id' => "",
            'theme' => $request->theme,
            'khadim' => $request->khadim,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/khadim')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteKhadim(){
        try{
            khadimModel::where('khadim_id',$_POST['khadim_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showKhadimModel(Request $request){
        $dataKhadim = khadimModel::orderByRaw("SUBSTRING_INDEX(khadim_id, '/', -1) + 0 ASC")->get();
        $row = $dataKhadim->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_majelis_ibadah_minggu = $dataKhadim[$row-1]->khadim_id;
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
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="khadim_id"> ID Khadim </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="khadim_id" name="khadim_id" value="'."KHDM/".$bulan."/".$tahun."/".$row.'">
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
                                <input type="text" class="form-control" autofocus required id="theme" name="theme" placeholder="Tema">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="khadim"> Khadim </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="khadim" name="khadim" placeholder="Khadim">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sermon_date"> Tanggal & Waktu </label>
                            </div>
                            <div class="col-xl-5">
                                <input type="date" class="form-control" required id="sermon_date" name="sermon_date" >
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" required id="time" name="time" placeholder="Waktu">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $dataKhadimModel = khadimModel::where('khadim_id',$_POST['khadim_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="khadim_id"> ID Khadim </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="khadim_id" name="khadim_id" value="'.$dataKhadimModel[0]->khadim_id.'">
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
                                <input type="text" class="form-control" id="theme" name="theme" value="'.$dataKhadimModel[0]->theme.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="khadim"> Khadim </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="khadim" name="khadim" value="'.$dataKhadimModel[0]->khadim.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="sermon_date"> Tanggal & Waktu </label>
                            </div>
                            <div class="col-xl-5">';
                            $tanggal = explode(' ',$dataKhadimModel[0]->sermon_date);
                $isi .='        <input type="date" class="form-control" required id="sermon_date" name="sermon_date" value="'.$tanggal[0].'">
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" required id="time" name="time" value="'.$dataKhadimModel[0]->time.'">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
