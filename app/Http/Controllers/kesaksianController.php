<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kesaksianModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;

class kesaksianController extends Controller
{
    public function readKesaksian(Request $request){
        $kesaksian = kesaksianModel::get();
        $row = $kesaksian->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $kesaksian = array_slice($kesaksian->toArray(),$starting_point,$per_page,true);
        $kesaksian= new LengthAwarePaginator($kesaksian, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'kesaksian' => $kesaksian
        ];
        return view('Website.Kesaksian.index',$data);
    }
    public function getAllKesaksian(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataKesaksian = kesaksianModel::orderByRaw("SUBSTRING_INDEX(testimony_id, '/', -1) + 0 DESC")->get();
        $count = count($dataKesaksian);
        $currentItems = $dataKesaksian->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';
        if(count($dataKesaksian) <= 0){
            $isi .='
                <tr>
                    <th colspan="6"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($paginator as $dS){
                $pisah = explode(' ',$dS->date_ofBirth);
                $tanggal_baru = explode('-',$pisah[0]);
                $isi .='
                    <tr>
                        <td>'.$dS->testimony_id.'</td>
                        <td>'.$dS->name.'</td>
                        <td>'.$dS->email.'</td>
                        <td>'.$dS->subject.'</td>
                        <td><div style="overflow-y: scroll;height:100px;">'.$dS->message.'</div></td>
                        <td> 
                            <button onclick="editKesaksianModal(`'.$dS->testimony_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteKesaksian(`'.$dS->testimony_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function createKesaksian(Request $request){
        kesaksianModel::create([
            'testimony_id' => $request->testimony_id,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        return redirect('/adm/website/kesaksian')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function updateKesaksian(Request $request){
        kesaksianModel::where('testimony_id',$request->testimony_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        return redirect('/adm/website/kesaksian')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteKesaksian(){
        try{
            kesaksianModel::where('testimony_id',$_POST['testimony_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function showKesaksianModel(Request $request){
        $dataKesaksian = kesaksianModel::orderByRaw("SUBSTRING_INDEX(testimony_id, '/', -1) + 0 ASC")->get();
        $row = $dataKesaksian->count();
        if($row == 0){
            $row = 1;
        }else{
            $id_Kesaksian = $dataKesaksian[$row-1]->testimony_id;
            $pisah = explode('/',$id_Kesaksian);
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
                                <label for="testimony_id"> ID Kesaksian </label>
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
            $dataKesaksianModel = kesaksianModel::where('testimony_id',$_POST['testimony_id'])->get(); 
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="testimony_id"> ID Kesaksian </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" readonly id="testimony_id" name="testimony_id" value="'.$dataKesaksianModel[0]->testimony_id.'">
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
                                <input type="text" class="form-control" id="name" name="name" value="'.$dataKesaksianModel[0]->name.'">
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
                                <input type="email" class="form-control" id="email" name="email" value="'.$dataKesaksianModel[0]->email.'">
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
                                <input type="text" class="form-control" id="subject" name="subject" value="'.$dataKesaksianModel[0]->subject.'">
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
                                    $dataKesaksianModel[0]->message;    
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
