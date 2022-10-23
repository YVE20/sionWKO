<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rapatEvaluasiModel;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class rapatEvaluasiController extends Controller
{
    public function readRapatEvaluasi(Request $request){
        $rapatEvaluasi = rapatEvaluasiModel::get();
        $row = $rapatEvaluasi->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $rapatEvaluasi = array_slice($rapatEvaluasi->toArray(),$starting_point,$per_page,true);
        $rapatEvaluasi= new LengthAwarePaginator($rapatEvaluasi, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'rapatEvaluasi' => $rapatEvaluasi
        ];
        return view('Pelayan.Rapat Evaluasi.index',$data);
    }
    public function createRapatEvaluasi(Request $request){
        rapatEvaluasiModel::create([
            'evaluationMeeting_id' => $request->evaluationMeeting_id,
            'evaluationMeeting' => $request->evaluationMeeting,
            'place' => $request->place,
            'date' => $request->date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/rapatEvaluasi')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function getAllRapatEvaluasi(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataRapatEvaluasi = rapatEvaluasiModel::orderByRaw("SUBSTRING_INDEX(evaluationMeeting_id, '/', -1) + 0 DESC")->get();
        $count = count($dataRapatEvaluasi);
        $currentItems = $dataRapatEvaluasi->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataRapatEvaluasi) <= 0){
            $isi .='
                <tr>
                    <th colspan="5"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            $row = 1;
            foreach($paginator as $dMIM){
                $pisah = explode(' ',$dMIM->date);
                $tanggal = explode('-',$pisah[0]);
                $jam = explode(':',$dMIM->time);
                $isi .='
                    <tr>
                        <td>'.$row++.'</td>
                        <td>'.$dMIM->evaluationMeeting_id.'</td>
                        <td>'.$dMIM->evaluationMeeting.'</td>
                        <td>'.$dMIM->place.'</td>
                        <td>'.$tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' || '.$jam[0].':'.$jam[1].'</td>
                        <td>
                            <button onclick="editRapatEvaluasiModal(`'.$dMIM->evaluationMeeting_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteRapatEvaluasi(`'.$dMIM->evaluationMeeting_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                    ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function updateRapatEvaluasi(Request $request){
        rapatEvaluasiModel::where('evaluationMeeting_id',$request->evaluationMeeting_id)->update([
            'evaluationMeeting' => $request->evaluationMeeting,
            'place' => $request->place,
            'date' => $request->date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/rapatEvaluasi')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteRapatEvaluasi(){
        try{
            rapatEvaluasiModel::where('evaluationMeeting_id',$_POST['evaluationMeeting_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showRapatEvaluasiModel(Request $request){
        $dataRapatEvaluasi = rapatEvaluasiModel::orderByRaw("SUBSTRING_INDEX(evaluationMeeting_id, '/', -1) + 0 ASC")->get();
        $row = $dataRapatEvaluasi->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_rapatEvaluasi = $dataRapatEvaluasi[$row-1]->evaluationMeeting_id;
            $pisah = explode('/',$id_rapatEvaluasi);
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
                                <label for="evaluationMeeting_id"> ID Rapat Evaluasi </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="evaluationMeeting_id" name="evaluationMeeting_id" value="'."RAPAT/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="evaluationMeeting"> Rapat </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="evaluationMeeting" name="evaluationMeeting" placeholder="Rapat">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="place"> Place </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="place" name="place" placeholder="Tempat">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date"> Tanggal & Waktu </label>
                            </div>
                            <div class="col-xl-5">
                                <input type="date" class="form-control" required id="date" name="date" >
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" required id="time" name="time" placeholder="Waktu">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $dataRapatEvaluasiModel = rapatEvaluasiModel::where('evaluationMeeting_id',$_POST['evaluationMeeting_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="evaluationMeeting_id"> ID Rapat Evaluasi </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="evaluationMeeting_id" name="evaluationMeeting_id" value="'.$dataRapatEvaluasiModel[0]->evaluationMeeting_id.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="evaluationMeeting"> Rapat </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="evaluationMeeting" name="evaluationMeeting" value="'.$dataRapatEvaluasiModel[0]->evaluationMeeting.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="place"> Place </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="place" name="place" value="'.$dataRapatEvaluasiModel[0]->place.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="date"> Tanggal & Waktu </label>
                            </div>
                            <div class="col-xl-5">';
                                $tanggal = explode(' ',$dataRapatEvaluasiModel[0]->date);
        $isi .='                <input type="date" class="form-control" id="date" name="date" value="'.$tanggal[0].'">
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" id="time" name="time" value="'.$dataRapatEvaluasiModel[0]->time.'">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
