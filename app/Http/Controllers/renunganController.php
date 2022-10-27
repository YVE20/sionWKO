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
        return view('Website.Renungan.index',$data);
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
                            <button onclick="deleteRenungan(`'.$dS->reflection_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function createRenungan(Request $request){
        $url = "https://api-alkitab.herokuapp.com/v2/passage/list";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Content-Type: application/json",
            "Content-Length: 0",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $resp = curl_exec($curl);
        $obj = json_decode($resp, TRUE);
        $singkatanKitab = "";
        foreach($obj['passage_list'] as $o){
          if($request->kitab == $o['book_name']){
            $singkatanKitab = $o['abbreviation'];
          }
        }
        if($singkatanKitab != ""){
            $urlAyat = "https://api-alkitab.herokuapp.com/v2/passage/";
            $urlLengkap = $urlAyat.$singkatanKitab."/".$request->pasal."/".$request->ayat."?ver=tb";
            $curlAyat = curl_init($urlLengkap);
            curl_setopt($curlAyat, CURLOPT_URL, $urlLengkap);
            curl_setopt($curlAyat, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
                "Content-Type: application/json",
                "Content-Length: 0",
            );
            curl_setopt($curlAyat, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curlAyat);
            $object = json_decode($response, TRUE);
            $ayatAlkitab = $object['verses'][0]['content'];
            renunganModel::create([
                'reflection_id' => $request->reflection_id,
                'reflection_title' => $request->reflection_title,
                'bible_verse' => $request->kitab." ".$request->pasal.":".$request->ayat,
                'verse' => $ayatAlkitab,
                'contents' => $request->contents,
            ]);
            return redirect('/adm/website/renungan')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);

        }else{
            return redirect('/adm/website/renungan')->with(["status"=>"Data batal disimpan", "judul_alert" => "Gagal" , "icon" => "error"]); 
        }
    }
    public function updateRenungan(Request $request){
        $url = "https://api-alkitab.herokuapp.com/v2/passage/list";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Content-Type: application/json",
            "Content-Length: 0",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $resp = curl_exec($curl);
        $obj = json_decode($resp, TRUE);
        $singkatanKitab = "";
        foreach($obj['passage_list'] as $o){
          if($request->kitab == $o['book_name']){
            $singkatanKitab = $o['abbreviation'];
          }
        }
        if($singkatanKitab != ""){
            $urlAyat = "https://api-alkitab.herokuapp.com/v2/passage/";
            $urlLengkap = $urlAyat.$singkatanKitab."/".$request->pasal."/".$request->ayat."?ver=tb";
            $curlAyat = curl_init($urlLengkap);
            curl_setopt($curlAyat, CURLOPT_URL, $urlLengkap);
            curl_setopt($curlAyat, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
                "Content-Type: application/json",
                "Content-Length: 0",
            );
            curl_setopt($curlAyat, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curlAyat);
            $object = json_decode($response, TRUE);
            $ayatAlkitab = $object['verses'][0]['content'];
            renunganModel::where('reflection_id',$request->reflection_id)->update([
                'reflection_title' => $request->reflection_title,
                'bible_verse' => $request->kitab." ".$request->pasal.":".$request->ayat,
                'verse' => $ayatAlkitab,
                'contents' => $request->contents,
            ]);
            return redirect('/adm/website/renungan')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);

        }else{
            return redirect('/adm/website/renungan')->with(["status"=>"Data batal disimpan", "judul_alert" => "Gagal" , "icon" => "error"]); 
        }
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
            $id_renungan = $dataRenungan[$row-1]->reflection_id;
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
                                <label for="reflection_id"> ID Renungan </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="reflection_id" name="reflection_id" value="'."REN/".$bulan."/".$tahun."/".$row.'"> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="reflection_title"> Judul </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="reflection_title" name="reflection_title" placeholder="Judul">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-4">
                                <label for="bible_verse"> Kitab </label>
                            </div>
                            <div class="col-xl-4 col-8">
                                <input type="text" class="form-control" required id="kitab" name="kitab" placeholder="Kitab">
                            </div>
                            <div class="col-xl-2 col-2">
                                <input type="text" class="form-control" required id="pasal" name="pasal" placeholder="Psl">
                            </div>
                            <div class="col-xl-2 col-2">
                                <input type="text" class="form-control" required id="ayat" name="ayat" placeholder="Ayt">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="contents"> Isi Renungan </label>
                            </div>
                            <div class="col-xl-8">
                                <textarea id="contents" class="form-control" name="contents" placeholder="Isi" style="resize:none;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $dataRenunganModel = renunganModel::where('reflection_id',$_POST['reflection_id'])->first(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="reflection_id"> ID Renungan </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="reflection_id" name="reflection_id" value="'.$dataRenunganModel->reflection_id.'"> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group"> 
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="reflection_title"> Judul </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" autofocus required id="reflection_title" name="reflection_title" value="'.$dataRenunganModel->reflection_title.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-4">
                                <label for="bible_verse"> Kitab </label>
                            </div>';
                            $splitKitab = explode(' ',$dataRenunganModel->bible_verse);
                            $splitPasal = explode(':',$splitKitab[1]);
            $isi .='        <div class="col-xl-4 col-8">
                                <input type="text" class="form-control" required id="kitab" name="kitab" value="'.$splitKitab[0].'">
                            </div>
                            <div class="col-xl-2 col-2">
                                <input type="text" class="form-control" required id="pasal" name="pasal" value="'.$splitPasal[0].'">
                            </div>
                            <div class="col-xl-2 col-2">
                                <input type="text" class="form-control" required id="ayat" name="ayat" value="'.$splitPasal[1].'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="contents"> Isi Renungan </label>
                            </div>
                            <div class="col-xl-8">
                                <textarea id="contents" class="form-control" name="contents" placeholder="Isi" style="resize:none;">'.$dataRenunganModel->contents.'</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
