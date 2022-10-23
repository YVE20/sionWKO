<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pemusikModel;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class pemusikController extends Controller
{
    public function readPemusik(Request $request){
        $pemusik = pemusikModel::get();
        $row = $pemusik->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $pemusik = array_slice($pemusik->toArray(),$starting_point,$per_page,true);
        $pemusik= new LengthAwarePaginator($pemusik, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'pemusik' => $pemusik
        ];
        return view('Pelayan.Pembagian Tugas.Pemusik.index',$data);
    }
    public function createPemusik(Request $request){
        $serviceCategory_id = "PMSK/2022";
        pemusikModel::create([
            'musician_id' => $request->musician_id,
            'serviceCategory_id' => $serviceCategory_id,
            'projector' => $request->projector,
            'infocus' => $request->infocus,
            'keyboard' => $request->keyboard,
            'prokantor' => $request->prokantor,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/pemusik')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function getAllPemusik(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataPemusik = pemusikModel::orderByRaw("SUBSTRING_INDEX(musician_id, '/', -1) + 0 DESC")->get();
        $count = count($dataPemusik);
        $currentItems = $dataPemusik->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataPemusik) <= 0){
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
                        <td>'.$dMIM->musician_id.'</td>
                        <td>'.$dMIM->projector.'</td>
                        <td>'.$dMIM->infocus.'</td>
                        <td>'.$dMIM->keyboard.'</td>
                        <td>'.$dMIM->prokantor.'</td>
                        <td>'.$tanggal[2].'-'.$tanggal[1].'-'.$tanggal[0].' || '.$jam[0].':'.$jam[1].'</td>
                        <td>
                            <button onclick="editPemusikModal(`'.$dMIM->musician_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deletePemusik(`'.$dMIM->musician_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                    ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function updatePemusik(Request $request){
        pemusikModel::where('musician_id',$request->musician_id)->update([
            'serviceCategory_id' => "",
            'projector' => $request->projector,
            'infocus' => $request->infocus,
            'keyboard' => $request->keyboard,
            'prokantor' => $request->prokantor,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time
        ]);
        return redirect('/adm/pelayan/pembagianTugas/pemusik')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deletePemusik(){
        try{
            pemusikModel::where('musician_id',$_POST['musician_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showPemusikModel(Request $request){
        $dataPemusik = pemusikModel::orderByRaw("SUBSTRING_INDEX(musician_id, '/', -1) + 0 ASC")->get();
        $row = $dataPemusik->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_pemusik = $dataPemusik[$row-1]->musician_id;
            $pisah = explode('/',$id_pemusik);
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
                                <label for="musician_id"> ID Pemusik </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="musician_id" name="musician_id" value="'."PMSK/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="projector"> Proyektor </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="projector" name="projector" placeholder="Proyektor">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="infocus"> Infocus </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="infocus" name="infocus" placeholder="Infokus">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="keyboard"> Keyboard </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="keyboard" name="keyboard" placeholder="Keyboard">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="prokantor"> Prokantor </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="prokantor" name="prokantor" placeholder="Prokantor">
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
            $dataPemusikModel = pemusikModel::where('musician_id',$_POST['musician_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="musician_id"> ID Pemusik </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="musician_id" name="musician_id" value="'.$dataPemusikModel[0]->musician_id.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="projector"> Proyektor </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="projector" name="projector" value="'.$dataPemusikModel[0]->projector.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="infocus"> Infocus </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="infocus" name="infocus" value="'.$dataPemusikModel[0]->infocus.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="keyboard"> Keyboard </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="keyboard" name="keyboard" value="'.$dataPemusikModel[0]->keyboard.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="prokantor"> Prokantor </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="prokantor" name="prokantor" value="'.$dataPemusikModel[0]->prokantor.'">
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
                            $tanggal = explode(' ',$dataPemusikModel[0]->sermon_date);
        $isi.='                 <input type="date" class="form-control" id="sermon_date" name="sermon_date" value="'.$tanggal[0].'">
                            </div>
                            <div class="col-xl-3">
                                <input type="time" class="form-control" id="time" name="time" value="'.$dataPemusikModel[0]->time.'">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
