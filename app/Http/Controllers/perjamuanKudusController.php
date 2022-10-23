<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventModel;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class perjamuanKudusController extends Controller
{
    public function readPerjamuanKudus(Request $request){
        $perjamuanKudus = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->where('tb_event.eventCategory_id','like','%PRKDS%')->get();
        $row = $perjamuanKudus->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $perjamuanKudus = array_slice($perjamuanKudus->toArray(),$starting_point,$per_page,true);
        $perjamuanKudus= new LengthAwarePaginator($perjamuanKudus, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'perjamuanKudus' => $perjamuanKudus
        ];
        return view('Event.Perjamuan Kudus.index',$data);
    }
    public function createPerjamuanKudus(Request $request){
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$request->event_id);

        if($request->hasFile('photo')){
            $photoFileName = $row[1].".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('EVENT')->putFileAs('PerjamuanKudus',$request->file('photo'),$photoFileName.'.'.$extPhotoFile);
        }else{
            $urlPhotoFile = "";
        }
        eventModel::create([
            'event_id' => $request->event_id,
            'eventCategory_id' => $request->eventCategory_id,
            'speaker' => $request->speaker,
            'place' => $request->place,
            'sermon_date' => $request->sermon_date,
            'address' => $request->address,
            'theme' => $request->theme,
            'contact_person' => $request->contact_person,
            'photo' => $urlPhotoFile,
        ]); 
        return redirect('/adm/event/perjamuanKudus')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function updatePerjamuanKudus(Request $request){
        $dataEventByID = eventModel::where('event_id',$_POST['event_id'])->first();
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$_POST['event_id']);

        if($request->hasFile('photo')){
            $photoFileName = $row[1].".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('EVENT')->putFileAs('PerjamuanKudus',$request->file('photo'),$photoFileName.'.'.$extPhotoFile);
        }else{
            $urlPhotoFile = $dataEventByID->photo;
        }
        eventModel::where('event_id',$_POST['event_id'])->update([
            'eventCategory_id' => $request->eventCategory_id,
            'speaker' => $request->speaker,
            'place' => $request->place,
            'sermon_date' => $request->sermon_date,
            'address' => $request->address,
            'theme' => $request->theme,
            'contact_person' => $request->contact_person,
            'photo' => $urlPhotoFile,
        ]); 
        return redirect('/adm/event/perjamuanKudus')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deletePerjamuanKudus(){
        try{
            eventModel::where('event_id',$_POST['event_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function getAllPerjamuanKudus(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataEventPerjamuanKudus = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->where('tb_event.eventCategory_id','like','%PRKDS%')->orderByRaw("SUBSTRING_INDEX(tb_event.event_id, '/', -1) + 0 DESC")->get();
        $count = count($dataEventPerjamuanKudus);
        $currentItems = $dataEventPerjamuanKudus->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataEventPerjamuanKudus) <= 0){
            $isi .='
                <tr>
                    <th colspan="9"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            $row = 1;
            foreach($paginator as $dEPK){
                $pisah = explode(' ',$dEPK->sermon_date);
                $tanggal_baru = explode('-',$pisah[0]);
                $isi .='
                    <tr>
                        <td>'.$row++.'</td>
                        <td>'.$dEPK->event_id.'</td>
                        <td>'.$tanggal_baru[2].'-'.$tanggal_baru[1].'-'.$tanggal_baru[0].'</td>
                        <td>'.$dEPK->address.'</td>
                        <td>'.$dEPK->theme.'</td>
                        <td>'.$dEPK->contact_person.'</td>';
                        if($dEPK->photo == NULL){
            $isi .='        <td>
                                <img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:50px;width:60px;cursor:pointer;">
                            </td>';
                        }else{
            $isi .='        <td>
                                <img src="'.asset('/uploads/EVENT/'.$dEPK->photo).'" style="height:50px;width:60px;cursor:pointer;">
                            </td>';
                        }
                $isi .='
                        <td> 
                            <button onclick="editPerjamuanKudusModel(`'.$dEPK->event_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="detelePerjamuanKudus(`'.$dEPK->event_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>   
                    </tr>
                ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
}
