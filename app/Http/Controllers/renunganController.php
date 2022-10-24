<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\renunganModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;

class renunganController extends Controller
{
    public function readRenungan(Request $request){
        $renungan = renunganModel::get();
        $row = $renungan->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $renungan = array_slice($renungan->toArray(),$starting_point,$per_page,true);
        $renungan= new LengthAwarePaginator($renungan, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'renungan' => $renungan
        ];
        return view('Website.renungan.index',$data);
    }
    public function getAllrenungan(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $datarenungan = renunganModel::orderByRaw("SUBSTRING_INDEX(reflection_id, '/', -1) + 0 DESC")->get();
        $count = count($datarenungan);
        $currentItems = $datarenungan->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';
        if(count($datarenungan) <= 0){
            $isi .='
                <tr>
                    <th colspan="6"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($paginator as $dS){
                $isi .='
                    <tr>
                        <td>'.$dS->reflection_id.'</td>
                        <td>'.$dS->reflection_title.'</td>
                        <td>'.$dS->bible_verse.'</td>
                        <td>'.$dS->verse.'</td>
                        <td><div style="overflow-y: scroll;height:100px;">'.$dS->contents.'</div></td>
                        <td> 
                            <button onclick="editRenunganModal(`'.$dS->reflection_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleterenungan(`'.$dS->reflection_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function createRenungan(Request $request){
        renunganModel::create([
            'reflection_id' => $request->reflection_id,
            'reflection_title' => $request->reflection_title,
            'bible_verse' => $request->bible_verse,
            'verse' => $request->verse,
            'contents' => $request->contents,
        ]);
        return redirect('/adm/website/renungan')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function updateRenungan(Request $request){
        renunganModel::where('reflection_id',$request->reflection_id)->update([
            'reflection_title' => $request->reflection_title,
            'bible_verse' => $request->bible_verse,
            'verse' => $request->verse,
            'contents' => $request->contents,
        ]);
        return redirect('/adm/website/renungan')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteRenungan(){
        try{
            renunganModel::where('reflection_id',$_POST['reflection_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showRenunganModel(Request $request){
        $dataRenungan = renunganModel::orderByRaw("SUBSTRING_INDEX(reflection_id, '/', -1) + 0 ASC")->get();
        $row = $dataRenungan->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_renungan = $dataRenungan[$row-1]->testimony_id;
            $pisah = explode('/',$id_renungan);
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
                                <label for="testimony_id"> ID renungan </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="testimony_id" name="testimony_id" value="'."KSK/".$bulan."/".$tahun."/".$row.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="name"> Nama </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="name" name="name" placeholder="Nama">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="email"> Email </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="email" class="form-control" required id="email" name="email" placeholder="Email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="subject"> Judul </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="subject" name="subject" placeholder="Judul">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="message"> Isi </label>
                            </div>
                            <div class="col-xl-8">
                                <textarea id="message" class="form-control" name="message" placeholder="Isi" style="resize:none;">
                                    
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $datarenunganModel = renunganModel::where('testimony_id',$_POST['testimony_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="testimony_id"> ID renungan </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="testimony_id" name="testimony_id" value="'.$datarenunganModel[0]->testimony_id.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="name"> Nama </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="name" name="name" value="'.$datarenunganModel[0]->name.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="email"> Email </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="email" class="form-control" id="email" name="email" value="'.$datarenunganModel[0]->email.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="subject"> Judul </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="subject" name="subject" value="'.$datarenunganModel[0]->subject.'">
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="message"> Isi </label>
                            </div>
                            <div class="col-xl-8">
                                <textarea id="message" class="form-control" name="message" placeholder="Isi" style="resize:none;">';
                                    $datarenunganModel[0]->message;    
            $isi .='            </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
