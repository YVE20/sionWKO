<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ibadahModel;
use App\Models\kategoriEventModel;
use App\Models\kategoriIbadahModel;
use Illuminate\Pagination\LengthAwarePaginator;

class ibadahController extends Controller
{
    public function createKategoriIbadah(Request $request){
        kategoriIbadahModel::create($request->all());
        return redirect('/adm/ibadah')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function readKategoriIbadah(){
        return "readKategoriIbadah";
    }
    public function updateKategoriIbadah(Request $request){
        kategoriIbadahModel::where('category_id',$request->category_id)->update([
            'category' => $request->category,
            'updated_at' => date_create()->format('Y-m-d H:i:s')
        ]);
        return redirect('/adm/ibadah')->with(["status"=>"Data berhasil dirubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteKategoriIbadah(){
        $kategoriIbadah = KategoriIbadahModel::where('category_id',$_POST['category_id'])->delete();
        return "success";
    }
    public function createIbadah(Request $request){
        if($request->category_id == "IBD/IBLP/2022" && $request->service_environtment == "-"){
            return redirect('/adm/ibadah')->with(["status"=>"Lingkungan Pelayanan tidak boleh kosong", "judul_alert" => "Peringatan" , "icon" => "warning"]);
        }else if($request->category_id == "IBD/IBKB/2022" && $request->service_environtment == "-"){
            return redirect('/adm/ibadah')->with(["status"=>"Lingkungan Pelayanan tidak boleh kosong", "judul_alert" => "Peringatan" , "icon" => "warning"]);
        }else if($request->category_id == "IBD/IBKI022" && $request->service_environtment == "-"){
            return redirect('/adm/ibadah')->with(["status"=>"Lingkungan Pelayanan tidak boleh kosong", "judul_alert" => "Peringatan" , "icon" => "warning"]);
        }else if($request->category_id == "IBD/IBMG/2022" && $request->service_environtment == "-"){
            return redirect('/adm/ibadah')->with(["status"=>"Lingkungan Pelayanan tidak boleh kosong", "judul_alert" => "Peringatan" , "icon" => "warning"]);
        }else if($request->category_id == "IBD/IBLL/2022" && $request->worship == "-"){
            return redirect('/adm/ibadah')->with(["status"=>"Jenis Ibadah tidak boleh kosong", "judul_alert" => "Peringatan" , "icon" => "warning"]);
        }else if($request->category_id == "-"){
            return redirect('/adm/ibadah')->with(["status"=>"Kategori Ibadah tidak boleh kosong", "judul_alert" => "Peringatan" , "icon" => "warning"]);
        }else{
            $worship = "";
            if($request->category_id == "IBD/IBLP/2022"){
                $worship = "Ibadah Lingkungan Pelayanan";
            }else if($request->category_id == "IBD/IBM/2022"){
                $worship = "Ibadah Minggu";
            }else if($request->category_id == "IBD/IBP/2022"){
                $worship = "Ibadah Pemuda";
            }else if($request->category_id == "IBD/IBR/2022"){
                $worship = "Ibadah Remaja";
            }else if($request->category_id == "IBD/IBKB/2022"){
                $worship = "Ibadah Kaum Bapak";
            }else if($request->category_id == "IBD/IBKI/2022"){
                $worship = "Ibadah Kaum Ibu";
            }else if($request->category_id == "IBD/IBMG/2022"){
                $worship = "Ibadah Minggu Gembira";
            }else if($request->category_id == "IBD/IBASM/2022"){
                $worship = "Ibadah Anak Sekolah Minggu";
            }else{ 
                $worship = $request->worship;
            }
            ibadahModel::create([
                'worship_id' => $request->worship_id,
                'category_id' => $request->category_id,
                'speaker' => $request->speaker,
                'sermon_title' => $request->sermon_title,
                'sermon_content' => $request->sermon_content,
                'place' => $request->place,
                'sermon_date' => $request->sermon_date,
                'time' => $request->time,
                'speaker_contact' => $request->speaker_contact,
                'service_environtment' => $request->service_environtment,
                'worship' => $worship,
            ]);
            return redirect('/adm/ibadah')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
        }
    }
    public function readIbadah(Request $request){
        $kategoriIbadah = kategoriIbadahModel::get();
        $row = $kategoriIbadah->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $kategoriIbadah = array_slice($kategoriIbadah->toArray(),$starting_point,$per_page,true);
        $kategoriIbadah= new LengthAwarePaginator($kategoriIbadah, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'kategoriIbadah' => $kategoriIbadah
        ];
        return view('KategoriIbadah.index',$data);
    }
    public function updateIbadah(Request $request){
        $worship = "";
        if($request->category_id == "IBD/IBLP/2022"){
            $worship = "Ibadah Lingkungan Pelayanan";
        }else if($request->category_id == "IBD/IBM/2022"){
            $worship = "Ibadah Minggu";
        }else if($request->category_id == "IBD/IBP/2022"){
            $worship = "Ibadah Pemuda";
        }else if($request->category_id == "IBD/IBR/2022"){
            $worship = "Ibadah Remaja";
        }else if($request->category_id == "IBD/IBKB/2022"){
            $worship = "Ibadah Kaum Bapak";
        }else if($request->category_id == "IBD/IBKI/2022"){
            $worship = "Ibadah Kaum Ibu";
        }else if($request->category_id == "IBD/IBMG/2022"){
            $worship = "Ibadah Minggu Gembira";
        }else if($request->category_id == "IBD/IBASM/2022"){
            $worship = "Ibadah Anak Sekolah Minggu";
        }else{ 
            $worship = $request->worship;
        }
        ibadahModel::where('worship_id',$request->worship_id)->update([
            'speaker' => $request->speaker,
            'sermon_title' => $request->sermon_title,
            'speaker_contact' => $request->speaker_contact,
            'place' => $request->place,
            'sermon_date' => $request->sermon_date,
            'time' => $request->time,
            'sermon_content' => $request->sermon_content,
            'worship' => $worship,
            'updated_at' =>  date_create()->format('Y-m-d H:i:s')
        ]);
        return redirect('/adm/ibadah')->with(["status"=>"Data berhasil dirubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteIbadah(){
        $ibadah = ibadahModel::where('worship_id',$_POST['worship_id'])->delete();
        return "success";
    }
    public function getWorshipByCategoryId(){
        $kategoriIbadah = kategoriIbadahModel::where('category_id',$_POST['category_id'])->first();
        return json_encode($kategoriIbadah);
    }
    public function editWorshipById($worship_id){
        $ibadah = ibadahModel::where('worship_id',$worship_id)->first();
        return json_encode($ibadah);
    }
    public function getAllKategoriIbadah(){
        $kategoriIbadah = kategoriIbadahModel::orderByRaw("SUBSTRING_INDEX(category_id, '/', -1) + 0 DESC")->get();
        $isi = '';
        if(count($kategoriIbadah) <= 0){
            $isi .='
                <tr>
                    <th colspan="3"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($kategoriIbadah as $kI){
                $isi .='
                    <tr>
                        <td>'. $kI->category_id .'</td>
                        <td>'. $kI->category .'</td>
                        <td>
                            <button onclick="editKategoriIbadah(`'.$kI->category_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteKategoriIbadah(`'.$kI->category_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>
                ';
            }
        }
        return $isi;
    }
    public function getAllWorship(){ 
        $chooseIbadah = $_POST['chooseIbadah'] == "-" ? "" : $_POST['chooseIbadah'];
        $chooseLingkunganPelayanan = $_POST['chooseLingkunganPelayanan'] ? $_POST['chooseLingkunganPelayanan'] : "";
        $chooseJenisIbadah = $_POST['chooseJenisIbadah'] ? $_POST['chooseJenisIbadah'] : "";
        $ibadah = new ibadahModel();
        
        if($chooseIbadah != "" && $chooseLingkunganPelayanan == "-" && $chooseJenisIbadah == "-"){
            $ibadah = $ibadah->where('category_id',$chooseIbadah);
        }else if($chooseIbadah != "" && $chooseLingkunganPelayanan != "-" && $chooseJenisIbadah == "-"){
            $ibadah = $ibadah->where('category_id',$chooseIbadah)->where('service_environtment',$chooseLingkunganPelayanan);
        }else if($chooseIbadah != "" && $chooseJenisIbadah != "-" && $chooseLingkunganPelayanan == "-"){
            $ibadah = $ibadah->where('category_id',$chooseIbadah)->where('worship',$chooseJenisIbadah);
        }
        else if($chooseIbadah != "" && $chooseLingkunganPelayanan != "-" && $chooseIbadah != "-"){
            $ibadah = $ibadah->where('category_id',$chooseIbadah)->where('service_environtment',$chooseLingkunganPelayanan)->where('worship',$chooseJenisIbadah);
        }
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $ibadah = $ibadah->orderByRaw("SUBSTRING_INDEX(worship_id, '/', -1) + 0 DESC")->get();
        $count = count($ibadah);
        $currentItems = $ibadah->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';
        if(count($ibadah) <= 0){
            $isi .='
                <tr>
                    <th colspan="9"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($paginator as $i){
                $pisah = explode(' ',$i->sermon_date);
                $tanggal_baru = explode('-',$pisah[0]);
                $jam = explode(':',$i->time);
                $isi .= '
                    <tr>
                        <td>'.$i->worship_id.'</td>
                        <td>'.$i->category_id.'</td>
                        <td>'.$i->speaker.'</td>
                        <td>'.$i->sermon_title.'</td>
                        <td>'.$i->place.'</td>
                        <td>'.$tanggal_baru[2].'-'.$tanggal_baru[1].'-'.$tanggal_baru[0].' ('.$jam[0].':'.$jam[1].' WIT)</td>
                        <td>'.$i->speaker_contact.'</td>
                        <td>'.$i->service_environtment.'</td>
                        <td>
                            <button onclick="editIbadahModal(`'.$i->worship_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteIbadah(`'.$i->worship_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>    
                ';
            }   
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function getLainlainWorship(){
        $chooseIbadah = $_POST['chooseIbadah'] == "-" ? "" : $_POST['chooseIbadah'];
        $chooseJenisIbadah = $_POST['chooseJenisIbadah'] ? $_POST['chooseJenisIbadah'] : "";
        print_r($chooseJenisIbadah);
        dd($chooseJenisIbadah);
        $ibadah = new ibadahModel();
        
        if($chooseIbadah != "" && $chooseJenisIbadah == "-"){
            $ibadah = $ibadah->where('category_id',$chooseIbadah);
        }else if($chooseIbadah != "" && $chooseJenisIbadah != "-"){
            $ibadah = $ibadah->where('category_id',$chooseIbadah)->where('worship',$chooseJenisIbadah);
        }
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $ibadah = $ibadah->orderByRaw("SUBSTRING_INDEX(worship_id, '/', -1) + 0 DESC")->get();
        $count = count($ibadah);
        $currentItems = $ibadah->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';
        if(count($ibadah) <= 0){
            $isi .='
                <tr>
                    <th colspan="9"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($paginator as $i){
                $pisah = explode(' ',$i->sermon_date);
                $tanggal_baru = explode('-',$pisah[0]);
                $jam = explode(':',$i->time);
                $isi .= '
                    <tr>
                        <td>'.$i->worship_id.'AA</td>
                        <td>'.$i->category_id.'AAA</td>
                        <td>'.$i->speaker.'</td>
                        <td>'.$i->sermon_title.'</td>
                        <td>'.$i->place.'</td>
                        <td>'.$tanggal_baru[2].'-'.$tanggal_baru[1].'-'.$tanggal_baru[0].' ('.$jam[0].':'.$jam[1].' WIT)</td>
                        <td>'.$i->speaker_contact.'</td>
                        <td>'.$i->service_environtment.'</td>
                        <td>
                            <button onclick="editIbadahModal(`'.$i->worship_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deleteIbadah(`'.$i->worship_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>
                    </tr>    
                ';
            }   
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
    public function showIbadahModel(){
        $kategoriIbadah = new kategoriIbadahModel();
        $isi = "";
        if($_POST['worship_id'] == ""){
            $kategoriIbadah = $kategoriIbadah->get();
            $dataIbadah = ibadahModel::orderBy('worship_id','DESC')->get();
            print_r($dataIbadah[0]['worship_id']);
            $row = $dataIbadah[0]['worship_id'] + 1;
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="category_id">ID Kategori</label>
                            </div>
                            <div class="col-xl-6">
                                <select name="category_id" onchange="pilihKategoriIbadah()" id="category_id" class="form-control">
                                    <option value="-"> --- KATEGORI IBADAH --- </option>';
                                        foreach($kategoriIbadah as $kI){
                                            $isi .='<option value="'.$kI->category_id.'"> '.$kI->category_id. '</option>';
                                        }
            $isi .='
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select name="service_environtment" style="display:none" id="service_environtment" class="form-control">
                                    <option value="-"> -- Lingkungan Pelayanan -- </option>
                                    <option value="1"> 1 </option>
                                    <option value="2"> 2 </option>
                                    <option value="3"> 3 </option>
                                    <option value="4"> 4 </option>
                                    <option value="5"> 5 </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="worship"> Kategori </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="category" placeholder="-" readonly>
                            </div>
                        </div>
                    </div>
                </div>';
                $isi .='
            <div class="row form-group">
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="worship_id">ID Ibadah </label>
                        </div>
                        <div class="col-xl-2">
                            <input type="text" class="form-control" readonly required id="worship_id" name="worship_id" value="'.$row.'">
                        </div>
                        <div class="col-xl-6">
                            <select class="form-control"  id="worship" name="worship" style="display:none">
                                <option value="-"> -- PILIH -- </option>
                                <option value="Ibadah Keluarga Pelayan"> Ibadah Keluarga Pelayan </option>
                                <option value="Ibadah Pelajar"> Ibadah Pelajar </option>
                                <option value="Ibadah Usinda"> Ibadah Usinda </option>
                                <option value="Ibadah Pergumulan MJ"> Ibadah Pergumulan MJ </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6" style="display:none">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="sermon_title"> Judul Khotbah </label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text" class="form-control" required id="sermon_title" name="sermon_title" placeholder="Judul Khotbah">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="speaker"> Pelayan </label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text" class="form-control" id="speaker" required name="speaker" placeholder="Pelayan">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="speaker_contact"> Narahubung </label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text" class="form-control" required id="speaker_contact" name="speaker_contact" placeholder="Narahubung">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="sermon_date"> Tempat Ibadah </label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text" class="form-control" required id="place" name="place" placeholder="Lokasi Ibadah">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="sermon_date"> Tanggal Ibadah </label>
                        </div>
                        <div class="col-xl-5">
                            <input type="date" class="form-control" required id="sermon_date" name="sermon_date" >
                        </div>
                        <div class="col-xl-3">
                            <input type="time" class="form-control" required id="time" name="time" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group" style="display:none;">
                <div class="col-xl-12">
                    <div class="row ">
                        <div class="col-xl-2">
                            <label for="sermon_content"> Isi Khotbah </label>
                        </div>
                        <div class="col-xl-10">
                            <textarea name="sermon_content" class="form-control" id="sermon_content" cols="30" rows="10" placeholder="Isi Khotbah" style="resize:none;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        ';
        }else{
            $ibadah = ibadahModel::join('tb_kategori_ibadah','tb_kategori_ibadah.category_id','tb_ibadah.category_id')->where('tb_ibadah.worship_id',$_POST['worship_id'])->get();;
            $kategoriIbadah = kategoriIbadahModel::get();
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="category_id">ID Kategori</label>
                            </div>
                            <div class="col-xl-6">
                                <select name="category_id" onchange="pilihKategoriIbadah()" id="category_id" class="form-control">
                                    <option value="-"> --- PILIH KATEGORI IBADAH --- </option>';
                                        foreach($kategoriIbadah as $kI){
                                            if($ibadah[0]->category_id == $kI->category_id){
                                                $isi .='<option value="'.$ibadah[0]->category_id.'" selected="selected" > '.$kI->category_id. '</option>';
                                            }   
                                        }
            $isi .='
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select name="service_environtment" style="display:none" id="service_environtment" class="form-control">
                                    <option value="-"> -- Lingkungan Pelayanan -- </option>';
                                    $service_environtment = array("1","2","3","4","5");
                                    foreach($service_environtment as $se){
                                        if($ibadah[0]->service_environtment == $se){
                                            $isi .='<option value="'.$ibadah[0]->service_environtment.'" selected>'.$ibadah[0]->service_environtment.'</option>';
                                        }
                                    }
                                    $reSE = array_diff($service_environtment, array($ibadah[0]->service_environtment));
                                    foreach($reSE as $rSE){
                                        $isi .='<option value="'.$rSE.'">'.$rSE.'</option>';
                                    }
            $isi .='            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="worship"> Kategori </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" id="category" value="'.$ibadah[0]->category.'" readonly>
                            </div>
                        </div>
                    </div>
                </div>';
                $isi .='
            <div class="row form-group">
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="worship_id">ID Ibadah </label>
                        </div>
                        <div class="col-xl-2">
                            <input type="text" class="form-control" readonly value="'.$ibadah[0]->worship_id.'" required id="worship_id" name="worship_id" placeholder="ID Ibadah">
                        </div>
                        <div class="col-xl-6">
                            <select name="worship" id="worship" class="form-control">
                                <option value="-"> -- PILIH </option>';
                                $worship = array("Ibadah Keluarga Pelayan","Ibadah Pelajar","Ibadah Usinda","Ibadah Pergumulan MJ");
                                    foreach($worship as $w){
                                        if($ibadah[0]->worship == $w){
                                            $isi .='<option value="'.$ibadah[0]->worship.'" selected>'.$ibadah[0]->worship.'</option>';
                                        }
                                    }
                                    $reW = array_diff($worship, array($ibadah[0]->worship));
                                    foreach($reW as $rW){
                                        $isi .='<option value="'.$rW.'">'.$rW.'</option>';
                                    }
                $isi .='    </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6" style="display:none;">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="sermon_title"> Judul Khotbah </label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text" class="form-control" value="'.$ibadah[0]->sermon_title.'" required id="sermon_title" name="sermon_title" placeholder="Judul Khotbah">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="speaker"> Pelayan </label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text" class="form-control" id="speaker" value="'.$ibadah[0]->speaker.'" required name="speaker" placeholder="Pelayan">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="speaker_contact"> Narahubung </label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text" class="form-control" required value="'.$ibadah[0]->speaker_contact.'" id="speaker_contact" name="speaker_contact" placeholder="Narahubung">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="sermon_date"> Tempat Ibadah </label>
                        </div>
                        <div class="col-xl-8">
                            <input type="text" class="form-control" value="'.$ibadah[0]->place.'" required id="place" name="place" placeholder="Lokasi Ibadah">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row ">
                        <div class="col-xl-4">
                            <label for="sermon_date"> Tanggal Ibadah </label>
                        </div>';
                        $pisah = explode(' ',$ibadah[0]->sermon_date);
        $isi .='
                        <div class="col-xl-5">
                            <input type="date" class="form-control" value="'.$pisah[0].'" required id="sermon_date" name="sermon_date" placeholder="Tanggal Ibadah">
                        </div>
                        <div class="col-xl-3">
                            <input type="time" class="form-control" value="'.$ibadah[0]->time.'" id="time" name="time" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group" style="display:none;">
                <div class="col-xl-12">
                    <div class="row ">
                        <div class="col-xl-2">
                            <label for="sermon_content"> Isi Khotbah </label>
                        </div>
                        <div class="col-xl-10">
                            <textarea name="sermon_content" class="form-control" id="sermon_content" cols="30" rows="10" placeholder="Isi Khotbah" style="resize:none;">'.$ibadah[0]->sermon_content.'</textarea>
                        </div>
                    </div>
                </div>
            </div>
        ';
        }
        
        echo $isi;
    }
    public function showKategoriIbadahModel(){
        $isi = '';
        if($_POST['cmd'] == "add"){
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="category_id"> ID Kategori </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="category_id" autofocus name="category_id" placeholder="IBD/xx/2022">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-4">
                                <label for="category"> Kategori </label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" class="form-control" required id="category" name="category" placeholder="Kategori">
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }else{
            $kategoriIbadah = kategoriIbadahModel::where('category_id',$_POST['category_id'])->first();
            $isi .='
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-2">
                                <label for="category_id"> ID Kategori </label>
                            </div>
                            <div class="col-xl-10">
                                <input type="text" class="form-control" readonly id="category_id" name="category_id" value="'.$kategoriIbadah->category_id.'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xl-12">
                        <div class="row ">
                            <div class="col-xl-2">
                                <label for="category"> Kategori </label>
                            </div>
                                <div class="col-xl-10">
                                    <input type="text" class="form-control" id="category" name="category" value="'.$kategoriIbadah->category.'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $isi;
    }
}
