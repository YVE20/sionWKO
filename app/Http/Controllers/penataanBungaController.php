<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penataanBungaModel;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class penataanBungaController extends Controller
{
    public function readPenataanBunga(Request $request){
        $penataanBunga = penataanBungaModel::get();
        $row = $penataanBunga->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $penataanBunga = array_slice($penataanBunga->toArray(),$starting_point,$per_page,true);
        $penataanBunga= new LengthAwarePaginator($penataanBunga, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'penataanBunga' => $penataanBunga
        ];
        return view('Pelayan.Pembagian Tugas.Penataan Bunga.index',$data);
    }
    public function createPenataanBunga(Request $request){
        $serviceCategory_id = "FA/2022";
        penataanBungaModel::create([
            'flowerArrangement_id' => $request->flowerArrangement_id,
            'serviceCategory_id' => $serviceCategory_id,
            'mothersOnDuty' => $request->mothersOnDuty,
            'coordinator' => $request->coordinator,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/penataanBunga')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function getAllPenataanBunga(){
        $chooseLingkunganPelayanan = $_POST['chooseLingkunganPelayanan'] == "-" ? "" : $_POST['chooseLingkunganPelayanan'];
        $dataPenataanBunga = new penataanBungaModel();
        if($chooseLingkunganPelayanan != ""){
            $string = "Lingkungan Pelayanan ";
            $string .=$chooseLingkunganPelayanan;
            $dataPenataanBunga = $dataPenataanBunga->where('mothersOnDuty',$string);
        }
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataPenataanBunga = $dataPenataanBunga->orderByRaw("SUBSTRING_INDEX(flowerArrangement_id, '/', -1) + 0 DESC")->get();
        $count = count($dataPenataanBunga);
        $currentItems = $dataPenataanBunga->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataPenataanBunga) <= 0){
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
                        <td>'.$dMIM->flowerArrangement_id.'</td>
                        <td>'.$dMIM->mothersOnDuty.'</td>
                        <td>'.$dMIM->coordinator.'</td>
                        <td>'.$tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' || '.$jam[0].':'.$jam[1].'</td>
                        <td>
                            <button onclick="editPenataanBungaModal(`'.$dMIM->flowerArrangement_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deletePenataanBunga(`'.$dMIM->flowerArrangement_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                    ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function updatePenataanBunga(Request $request){
        penataanBungaModel::where('flowerArrangement_id',$request->flowerArrangement_id)->update([
            'serviceCategory_id' => "",
            'mothersOnDuty' => $request->mothersOnDuty,
            'coordinator' => $request->coordinator,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/penataanBunga')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deletePenataanBunga(){
        try{
            penataanBungaModel::where('flowerArrangement_id',$_POST['flowerArrangement_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showPenataanBungaModel(Request $request){
        $dataPenataanBunga = penataanBungaModel::orderByRaw("SUBSTRING_INDEX(flowerArrangement_id, '/', -1) + 0 ASC")->get();
        $row = $dataPenataanBunga->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_majelis_ibadah_minggu = $dataPenataanBunga[$row-1]->flowerArrangement_id;
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
                                <label for="flowerArrangement_id"> ID Penata </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="flowerArrangement_id" name="flowerArrangement_id" value="'."FLW/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="mothersOnDuty"> Kaum Ibu </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="mothersOnDuty" name="mothersOnDuty" placeholder="Kaum Ibu Bertugas">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="coordinator"> Koordinator </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="coordinator" name="coordinator" placeholder="Koordinator">
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
                                <input type="date" class="form-control" required id="sermon_date" name="sermon_date" placeholder="Seragam">
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" required id="time" name="time" placeholder="Waktu">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $dataPenataanBungaModel = penataanBungaModel::where('flowerArrangement_id',$_POST['flowerArrangement_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="flowerArrangement_id"> ID Penata </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="flowerArrangement_id" name="flowerArrangement_id" value="'.$dataPenataanBungaModel[0]->flowerArrangement_id.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="mothersOnDuty"> Kaum Ibu </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="mothersOnDuty" name="mothersOnDuty" value="'.$dataPenataanBungaModel[0]->mothersOnDuty.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="coordinator"> Koordinator </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="coordinator" name="coordinator" value="'.$dataPenataanBungaModel[0]->coordinator.'">
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
                            $tanggal = explode(' ',$dataPenataanBungaModel[0]->sermon_date);
            $isi .='             <input type="date" class="form-control" id="sermon_date" name="sermon_date" value="'.$tanggal[0].'">
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" id="time" name="time" value="'.$dataPenataanBungaModel[0]->time.'">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
