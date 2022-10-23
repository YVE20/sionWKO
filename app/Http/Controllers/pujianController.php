<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pujianModel;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class pujianController extends Controller
{
    public function readPujian(Request $request){
        $pujian = pujianModel::get();
        $row = $pujian->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $pujian = array_slice($pujian->toArray(),$starting_point,$per_page,true);
        $pujian= new LengthAwarePaginator($pujian, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'pujian' => $pujian
        ];
        return view('Pelayan.Pembagian Tugas.Pujian.index',$data);
    }
    public function createPujian(Request $request){
        $serviceCategory_id = "PJN/2022";
        pujianModel::create([
            'singing_id' => $request->singing_id,
            'serviceCategory_id' => $serviceCategory_id,
            'singer' => $request->singer,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/pujian')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function getAllPujian(){
        $searchSinger = $_POST['searchSinger'] ? $_POST['searchSinger'] : "";
        $dataPujian = new  pujianModel();
        if($searchSinger != ""){
            $dataPujian = $dataPujian->where('singer','like','%'.$searchSinger.'%');
        }
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataPujian = $dataPujian->orderByRaw("SUBSTRING_INDEX(singing_id, '/', -1) + 0 DESC")->get();
        $count = count($dataPujian);
        $currentItems = $dataPujian->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataPujian) <= 0){
            $isi .='
                <tr>
                    <th colspan="5"> <center> TIDAK ADA DATA </center> </th>
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
                        <td>'.$dMIM->singing_id.'</td>
                        <td>'.$dMIM->singer.'</td>
                        <td>'.$tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' || '.$jam[0].':'.$jam[1].'</td>
                        <td>
                            <button onclick="editPujianModal(`'.$dMIM->singing_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deletePujian(`'.$dMIM->singing_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                    ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function updatePujian(Request $request){
        pujianModel::where('singing_id',$request->singing_id)->update([
            'serviceCategory_id' => "",
            'singer' => $request->singer,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/pujian')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deletePujian(){
        try{
            PujianModel::where('singing_id',$_POST['singing_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showPujianModel(Request $request){
        $dataPujian = PujianModel::orderByRaw("SUBSTRING_INDEX(singing_id, '/', -1) + 0 ASC")->get();
        $row = $dataPujian->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_pujian = $dataPujian[$row-1]->singing_id;
            $pisah = explode('/',$id_pujian);
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
                                <label for="singing_id"> ID Pujian </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="singing_id" name="singing_id" value="'."SGR/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="singer"> Singer </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="singer" name="singer" placeholder="Singer">
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
            $dataPujianModel = pujianModel::where('singing_id',$_POST['singing_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="singing_id"> ID Pujian </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="singing_id" name="singing_id" value="'.$dataPujianModel[0]->singing_id.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="singer"> Singer </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="singer" name="singer" value="'.$dataPujianModel[0]->singer.'">
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
                            $tanggal = explode(' ',$dataPujianModel[0]->sermon_date);
        $isi .='                <input type="date" class="form-control" id="sermon_date" name="sermon_date" value="'.$tanggal[0].'">
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" id="time" name="time" value="'.$dataPujianModel[0]->time.'">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
