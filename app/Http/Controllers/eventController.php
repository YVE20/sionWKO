<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventModel;
use Illuminate\Support\Facades\DB;
use App\Models\kategoriEventModel;

class eventController extends Controller
{
    public function showAllEventModel(Request $request){
        $isi = '';
        if($_POST['cmd'] == "add"){ 
            $dataEventModel = eventModel::orderByRaw("SUBSTRING_INDEX(event_id, '/', -1) + 0 ASC")->get();
            $row = $dataEventModel->count();
            if($row == 0){
                $row = 1;
            }else{
                $id_event = $dataEventModel[$row-1]->event_id;
                $pisah = explode('/',$id_event);
                $row = $pisah[1] + 1;
            }
            if($_POST['kategoriEvent'] == "HUT"){
                $kategoriEventHUTModel = kategoriEventModel::where('eventCategory_id','like','%HUT%')->get();
                $isi .='
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="eventCategory_id"> ID Kategori Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <select id="eventCategory_id" onchange="pilihKategoriEvent()" required name="eventCategory_id" class="form-control">
                                        <option value="-"> -- ID Kategori Event -- </option>';
                                        foreach ($kategoriEventHUTModel as $key => $kEM) {
                                            $isi .='<option value="'.$kEM->eventCategory_id.'"> '.$kEM->eventCategory_id.' </option>';
                                        }
                $isi .='            </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="aa"> Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" readonly class="form-control" id="even" placeholder="-">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="event_id"> ID Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" readonly required id="event_id" name="event_id" value="'."EVT/".$row.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="speaker"> Pembicara </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="speaker" name="speaker" placeholder="Hamba Tuhan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="place"> Tempat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="place" id="place" placeholder="Tempat">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="sermon_date"> Tanggal </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="date" class="form-control" required name="sermon_date" id="sermon_date" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="theme"> Tema </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="theme" id="theme" placeholder="Tema">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="address"> Alamat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="address" name="address" placeholder="Alamat">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="contact_person"> Narahubung </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="contact_person" name="contact_person" placeholder="Narahubung">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="photo"> Poster </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="file" class="form-control" name="photo" id="photo" >
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }else if($_POST['kategoriEvent'] == "ReformasiGereja"){
                $kategoriEventReformasiGerejaModel = kategoriEventModel::where('eventCategory_id','like','%HRFG%')->get();
                $isi .='
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="eventCategory_id"> ID Kategori Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <select id="eventCategory_id" onchange="pilihKategoriEvent()" required name="eventCategory_id" class="form-control">
                                        <option value="-"> -- ID Kategori Event -- </option>';
                                        foreach ($kategoriEventReformasiGerejaModel as $key => $kEM) {
                                            $isi .='<option value="'.$kEM->eventCategory_id.'"> '.$kEM->eventCategory_id.' </option>';
                                        }
                $isi .='            </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="aa"> Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" readonly class="form-control" id="even" placeholder="-">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="event_id"> ID Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" readonly required id="event_id" name="event_id" value="'."EVT/".$row.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="speaker"> Pembicara </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="speaker" name="speaker" placeholder="Hamba Tuhan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="place"> Tempat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="place" id="place" placeholder="Tempat">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="sermon_date"> Tanggal </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="date" class="form-control" required name="sermon_date" id="sermon_date" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="theme"> Tema </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="theme" id="theme" placeholder="Tema">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="address"> Alamat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="address" name="address" placeholder="Alamat">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="contact_person"> Narahubung </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="contact_person" name="contact_person" placeholder="Narahubung">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="photo"> Poster </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="file" class="form-control" name="photo" id="photo" >
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }else if($_POST['kategoriEvent'] == "PerjamuanKudus"){
                $kategoriEventPerjamuanKudusModel = kategoriEventModel::where('eventCategory_id','like','%PRKDS%')->get();
                $isi .='
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="eventCategory_id"> ID Kategori Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <select id="eventCategory_id" onchange="pilihKategoriEvent()" required name="eventCategory_id" class="form-control">
                                        <option value="-"> -- ID Kategori Event -- </option>';
                                        foreach ($kategoriEventPerjamuanKudusModel as $key => $kEPK) {
                                            $isi .='<option value="'.$kEPK->eventCategory_id.'"> '.$kEPK->eventCategory_id.' </option>';
                                        }
                $isi .='            </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="aa"> Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" readonly class="form-control" id="even" placeholder="-">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="event_id"> ID Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" readonly required id="event_id" name="event_id" value="'."EVT/".$row.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="speaker"> Pembicara </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="speaker" name="speaker" placeholder="Hamba Tuhan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="place"> Tempat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="place" id="place" placeholder="Tempat">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="sermon_date"> Tanggal </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="date" class="form-control" required name="sermon_date" id="sermon_date" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="theme"> Tema </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="theme" id="theme" placeholder="Tema">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="address"> Alamat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="address" name="address" placeholder="Alamat">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="contact_person"> Narahubung </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="contact_person" name="contact_person" placeholder="Narahubung">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="photo"> Poster </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="file" class="form-control" name="photo" id="photo" >
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        }else{
            $eventModel = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->where('event_id',$_POST['event_id'])->first();
            if($_POST['kategoriEvent'] == "HUT"){
                $isi .='
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="eventCategory_id"> ID Kategori Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <select id="eventCategory_id" onchange="pilihKategoriEvent()" required name="eventCategory_id" class="form-control">
                                        <option value="-"> -- ID Kategori Event -- </option>';
                                        $eventKategori = array("EVT/HUT/GM","EVT/HUT/GMIH","EVT/HUT/GS","EVT/HUT/RP");
                                        foreach($eventKategori as $r){
                                            if($eventModel->eventCategory_id == $r){
                                                $isi .='<option value="'.$eventModel->eventCategory_id.'" selected>'.$eventModel->eventCategory_id.'</option>';
                                            }
                                        }
                                        $reEK = array_diff($eventKategori, array($eventModel->eventCategory_id));
                                        foreach($reEK as $rEK){
                                            $isi .='<option value="'.$rEK.'">'.$rEK.'</option>';
                                        }
                $isi .='            </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="aa"> Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" readonly class="form-control" id="even" value="'.$eventModel->event.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="event_id"> ID Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" readonly required id="event_id" name="event_id" value="'.$eventModel->event_id.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="speaker"> Pembicara </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="speaker" name="speaker" value="'.$eventModel->speaker.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="place"> Tempat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="place" id="place" value="'.$eventModel->place.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="sermon_date"> Tanggal </label>
                                </div>
                                <div class="col-xl-8">';
                                    $tanggal = explode(' ',$eventModel->sermon_date);
                $isi .='            <input type="date" class="form-control" required value="'.$tanggal[0].'" name="sermon_date" id="sermon_date" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="theme"> Tema </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="theme" id="theme" value="'.$eventModel->theme.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="address"> Alamat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="address" name="address" value="'.$eventModel->address.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="contact_person"> Narahubung </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="contact_person" name="contact_person" value="'.$eventModel->contact_person.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="photo"> Poster </label>
                                </div>
                                <div class="col-xl-3">
                                    <input type="file" class="form-control" name="photo" id="photo" >
                                </div>
                                <div class="col-xl-5">';
                                    if($eventModel->photo == NULL){
                                        $isi .='<img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:150px;width:200px;cursor:pointer;">';
                                    }else{
                                    $isi .='<img src="'.asset('/uploads/EVENT/'.$eventModel->photo).'" style="height:150px;width:200px;cursor:pointer;">';
                                    }
                $isi .='        </div>
                            </div>
                        </div>
                    </div>
                ';
            }else if($_POST['kategoriEvent'] == "ReformasiGereja"){
                $isi .='
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="eventCategory_id"> ID Kategori Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <select id="eventCategory_id" onchange="pilihKategoriEvent()" required name="eventCategory_id" class="form-control">
                                        <option value="-"> -- ID Kategori Event -- </option>';
                                        $eventKategori = array("EVT/HRFG","EVT/HUT/GM","EVT/HUT/GMIH","EVT/HUT/GS","EVT/HUT/RP","EVT/PRKDS");
                                        foreach($eventKategori as $r){
                                            if($eventModel->eventCategory_id == $r){
                                                $isi .='<option value="'.$eventModel->eventCategory_id.'" selected>'.$eventModel->eventCategory_id.'</option>';
                                            }
                                        }
                $isi .='            </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="aa"> Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" readonly class="form-control" id="even" value="'.$eventModel->event.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="event_id"> ID Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" readonly required id="event_id" name="event_id" value="'.$eventModel->event_id.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="speaker"> Pembicara </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="speaker" name="speaker" value="'.$eventModel->speaker.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="place"> Tempat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="place" id="place" value="'.$eventModel->place.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="sermon_date"> Tanggal </label>
                                </div>
                                <div class="col-xl-8">';
                                    $tanggal = explode(' ',$eventModel->sermon_date);
                $isi .='            <input type="date" class="form-control" required value="'.$tanggal[0].'" name="sermon_date" id="sermon_date" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="theme"> Tema </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="theme" id="theme" value="'.$eventModel->theme.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="address"> Alamat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="address" name="address" value="'.$eventModel->address.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="contact_person"> Narahubung </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="contact_person" name="contact_person" value="'.$eventModel->contact_person.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="photo"> Poster </label>
                                </div>
                                <div class="col-xl-3">
                                    <input type="file" class="form-control" name="photo" id="photo" >
                                </div>
                                <div class="col-xl-5">';
                                    if($eventModel->photo == NULL){
                                        $isi .='<img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:150px;width:200px;cursor:pointer;">';
                                    }else{
                                    $isi .='<img src="'.asset('/uploads/EVENT/'.$eventModel->photo).'" style="height:150px;width:200px;cursor:pointer;">';
                                    }
                $isi .='        </div>
                            </div>
                        </div>
                    </div>
                ';
            }else if($_POST['kategoriEvent'] == "PerjamuanKudus"){
                $isi .='
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="eventCategory_id"> ID Kategori Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <select id="eventCategory_id" onchange="pilihKategoriEvent()" required name="eventCategory_id" class="form-control">
                                        <option value="-"> -- ID Kategori Event -- </option>';
                                        $eventKategori = array("EVT/PRKDS");
                                        foreach($eventKategori as $r){
                                            if($eventModel->eventCategory_id == $r){
                                                $isi .='<option value="'.$eventModel->eventCategory_id.'" selected>'.$eventModel->eventCategory_id.'</option>';
                                            }
                                        }
                $isi .='            </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="aa"> Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" readonly class="form-control" id="even" value="'.$eventModel->event.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="event_id"> ID Event </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" readonly required id="event_id" name="event_id" value="'.$eventModel->event_id.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="speaker"> Pembicara </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="speaker" name="speaker" value="'.$eventModel->speaker.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="place"> Tempat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="place" id="place" value="'.$eventModel->place.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="sermon_date"> Tanggal </label>
                                </div>
                                <div class="col-xl-8">';
                                    $tanggal = explode(' ',$eventModel->sermon_date);
                $isi .='            <input type="date" class="form-control" required value="'.$tanggal[0].'" name="sermon_date" id="sermon_date" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="theme"> Tema </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required name="theme" id="theme" value="'.$eventModel->theme.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="address"> Alamat </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="address" name="address" value="'.$eventModel->address.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="contact_person"> Narahubung </label>
                                </div>
                                <div class="col-xl-8">
                                    <input type="text" class="form-control" required id="contact_person" name="contact_person" value="'.$eventModel->contact_person.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row ">
                                <div class="col-xl-4">
                                    <label for="photo"> Poster </label>
                                </div>
                                <div class="col-xl-3">
                                    <input type="file" class="form-control" name="photo" id="photo" >
                                </div>
                                <div class="col-xl-5">';
                                    if($eventModel->photo == NULL){
                                        $isi .='<img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:150px;width:200px;cursor:pointer;">';
                                    }else{
                                    $isi .='<img src="'.asset('/uploads/EVENT/'.$eventModel->photo).'" style="height:150px;width:200px;cursor:pointer;">';
                                    }
                $isi .='        </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        }
        return $isi;
    }
}
