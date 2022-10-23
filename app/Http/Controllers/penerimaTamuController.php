<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penerimaTamuModel;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class penerimaTamuController extends Controller
{
    public function readPenerimaTamu(Request $request){
        $penerimaTamu = penerimaTamuModel::get();
        $row = $penerimaTamu->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $penerimaTamu = array_slice($penerimaTamu->toArray(),$starting_point,$per_page,true);
        $penerimaTamu= new LengthAwarePaginator($penerimaTamu, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'penerimaTamu' => $penerimaTamu
        ];
        return view('Pelayan.Pembagian Tugas.Penerima Tamu.index',$data);
    }
    public function createPenerimaTamu(Request $request){
        $serviceCategory_id = "PNTM/2022";
        penerimaTamuModel::create([
            'welcoming_id' => $request->welcoming_id,
            'serviceCategory_id' => $serviceCategory_id,
            'welcomer' => $request->welcomer,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/penerimaTamu')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function getAllPenerimaTamu(){
        $searchPenerimaTamu = $_POST['searchPenerimaTamu'] ? $_POST['searchPenerimaTamu'] : "";
        $dataPenerimaTamu = new penerimaTamuModel();
        if($searchPenerimaTamu != ""){
            $dataPenerimaTamu = $dataPenerimaTamu->where('welcomer','like','%'.$searchPenerimaTamu.'%');
        }
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataPenerimaTamu = $dataPenerimaTamu->orderByRaw("SUBSTRING_INDEX(welcoming_id, '/', -1) + 0 DESC")->get();
        $count = count($dataPenerimaTamu);
        $currentItems = $dataPenerimaTamu->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataPenerimaTamu) <= 0){
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
                        <td>'.$dMIM->welcoming_id.'</td>
                        <td>'.$dMIM->welcomer.'</td>
                        <td>'.$tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' || '.$jam[0].':'.$jam[1].'</td>
                        <td>
                            <button onclick="editPenerimaTamuModal(`'.$dMIM->welcoming_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deletePenerimaTamu(`'.$dMIM->welcoming_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                    ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function updatePenerimaTamu(Request $request){
        penerimaTamuModel::where('welcoming_id',$request->welcoming_id)->update([
            'serviceCategory_id' => "",
            'welcomer' => $request->welcomer,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/penerimaTamu')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deletePenerimaTamu(){
        try{
            penerimaTamuModel::where('welcoming_id',$_POST['welcoming_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showPenerimaTamuModel(Request $request){
        $dataPenerimaTamu = penerimaTamuModel::orderByRaw("SUBSTRING_INDEX(welcoming_id, '/', -1) + 0 ASC")->get();
        $row = $dataPenerimaTamu->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_penerima_tamu = $dataPenerimaTamu[$row-1]->welcoming_id;
            $pisah = explode('/',$id_penerima_tamu);
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
                                <label for="welcoming_id"> ID Penerima Tamu </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="welcoming_id" name="welcoming_id" value="'."PNRTM/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="welcomer"> Welcomer </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="welcomer" name="welcomer" placeholder="Penerima Tamu">
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
            $dataPenerimaTamuModel = penerimaTamuModel::where('welcoming_id',$_POST['welcoming_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="welcoming_id"> ID PenerimaTamu </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="welcoming_id" name="welcoming_id" value="'.$dataPenerimaTamuModel[0]->welcoming_id.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="welcomer"> Penerima Tamu </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="welcomer" name="welcomer" value="'.$dataPenerimaTamuModel[0]->welcomer.'">
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
                            $tanggal = explode(' ',$dataPenerimaTamuModel[0]->sermon_date);
        $isi .='                <input type="date" class="form-control" id="sermon_date" name="sermon_date" value="'.$tanggal[0].'">
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" id="time" name="time" value="'.$dataPenerimaTamuModel[0]->time.'">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
