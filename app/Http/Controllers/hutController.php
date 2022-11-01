<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventModel;
use App\Models\kategoriEventModel;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class hutController extends Controller
{
    public function readHUT(Request $request){
        $HUT = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->where('tb_event.eventCategory_id','like','%HUT%')->get();
        $row = $HUT->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $HUT = array_slice($HUT->toArray(),$starting_point,$per_page,true);
        $HUT= new LengthAwarePaginator($HUT, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'HUT' => $HUT
        ];
        return view('Event.HUT.index',$data);
    }
    public function getEventByEventCategoryId(){
        $kategoriEvent = kategoriEventModel::where('eventCategory_id',$_POST['eventCategory_id'])->first();
        return $kategoriEvent;
    }
    public function createHUT(Request $request){
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$request->event_id);

        if($request->hasFile('photo')){
            $photoFileName = $row[1].".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('EVENT')->putFileAs('HUT',$request->file('photo'),$photoFileName.'.'.$extPhotoFile);
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
        return redirect('/adm/event/HUT')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function updateHUT(Request $request){
        $dataEventByID = eventModel::where('event_id',$_POST['event_id'])->first();
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$_POST['event_id']);

        if($request->hasFile('photo')){
            $photoFileName = $row[1].".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('EVENT')->putFileAs('HUT',$request->file('photo'),$photoFileName.'.'.$extPhotoFile);
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
        return redirect('/adm/event/HUT')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteHUT(){
        try{
            eventModel::where('event_id',$_POST['event_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function getAllHUT(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataEventHUT = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->where('tb_event.eventCategory_id','like','%HUT%')->orderByRaw("SUBSTRING_INDEX(tb_event.event_id, '/', -1) + 0 DESC")->get();
        $count = count($dataEventHUT);
        $currentItems = $dataEventHUT->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataEventHUT) <= 0){
            $isi .='
                <tr>
                    <th colspan="9"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            foreach($paginator as $dEH){
                $pisah = explode(' ',$dEH->sermon_date);
                $tanggal_baru = explode('-',$pisah[0]);
                $isi .='
                    <tr>
                        <td>'.$dEH->event_id.'</td>
                        <td>'.$dEH->event.'</td>
                        <td>'.$tanggal_baru[2].'-'.$tanggal_baru[1].'-'.$tanggal_baru[0].'</td>
                        <td>'.$dEH->place.'</td>
                        <td>'.$dEH->theme.'</td>
                        <td>'.$dEH->contact_person.'</td>';
                        if($dEH->photo == NULL){
            $isi .='        <td>
                                <img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:30px;width:60px;cursor:pointer;">
                            </td>';
                        }else{
            $isi .='        <td>
                                <img src="'.asset('/uploads/EVENT/'.$dEH->photo).'" style="height:30px;width:60px;cursor:pointer;">
                            </td>';
                        }
                $isi .='
                        <td> 
                            <button onclick="editHUTModel(`'.$dEH->event_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deteleHUT(`'.$dEH->event_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>   
                    </tr>
                ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
}
