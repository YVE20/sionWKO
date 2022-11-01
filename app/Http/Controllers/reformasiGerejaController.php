<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\eventModel;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class reformasiGerejaController extends Controller
{
    public function readReformasiGereja(Request $request){
        $reformasiGereja = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->where('tb_event.eventCategory_id','like','%HRFG%')->get();
        $row = $reformasiGereja->count();
        $per_page = 10;
        $current_page = $request->input("page") ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;
        $reformasiGereja = array_slice($reformasiGereja->toArray(),$starting_point,$per_page,true);
        $reformasiGereja= new LengthAwarePaginator($reformasiGereja, $row, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
        $data = [
            'reformasiGereja' => $reformasiGereja
        ];
        return view('Event.Hari Reformasi Gereja.index',$data);
    }
    public function createReformasiGereja(Request $request){
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$request->event_id);

        if($request->hasFile('photo')){
            $photoFileName = $row[1].".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('EVENT')->putFileAs('ReformasiGereja',$request->file('photo'),$photoFileName.'.'.$extPhotoFile);
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
            'time' => $request->time
        ]); 
        return redirect('/adm/event/reformasiGereja')->with(["status"=>"Data berhasil disimpan", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function updateReformasiGereja(Request $request){
        $dataEventByID = eventModel::where('event_id',$_POST['event_id'])->first();
        $date = date('m/Y');
        $split = explode('/', $date);
        $row = explode('/',$_POST['event_id']);

        if($request->hasFile('photo')){
            $photoFileName = $row[1].".".$split[0].".".$split[1].".";
            $extPhotoFile = $request->file('photo')->extension();
            $urlPhotoFile = Storage::disk('EVENT')->putFileAs('ReformasiGereja',$request->file('photo'),$photoFileName.'.'.$extPhotoFile);
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
            'time' => $request->time
        ]); 
        return redirect('/adm/event/reformasiGereja')->with(["status"=>"Data berhasil diubah", "judul_alert" => "Berhasil" , "icon" => "success"]);
    }
    public function deleteReformasiGereja(){
        try{
            eventModel::where('event_id',$_POST['event_id'])->delete();
            return "success";
        }
        catch(Exception $ex){
            throw $ex;
        }
    }
    public function getAllReformasiGereja(){
        $perPage = 10;
        $currentPage = isset($_POST["page"])? $_POST["page"] : 1;
        $dataEventReformasiGereja = eventModel::join('tb_kategori_event','tb_kategori_event.eventCategory_id','tb_event.eventCategory_id')->where('tb_event.eventCategory_id','like','%HRFG%')->orderByRaw("SUBSTRING_INDEX(tb_event.event_id, '/', -1) + 0 DESC")->get();
        $count = count($dataEventReformasiGereja);
        $currentItems = $dataEventReformasiGereja->slice($perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, $count, $perPage, $currentPage);
        $isi = '';

        if(count($dataEventReformasiGereja) <= 0){
            $isi .='
                <tr>
                    <th colspan="9"> <center> TIDAK ADA DATA </center> </th>
                </tr>
            ';
        }else{
            $row = 1;
            foreach($paginator as $dERG){
                $pisah = explode(' ',$dERG->sermon_date);
                $tanggal_baru = explode('-',$pisah[0]);
                $pisahJam = explode(':',$dERG->time);
                $isi .='
                    <tr>
                        <td>'.$row++.'</td>
                        <td>'.$dERG->event_id.'</td>
                         <td>'.$tanggal_baru[2].'-'.$tanggal_baru[1].'-'.$tanggal_baru[0].' ('.$pisahJam[0].':'.$pisahJam[1].' WIT)</td>
                        <td>'.$dERG->place.'</td>
                        <td>'.$dERG->theme.'</td>
                        <td>'.$dERG->contact_person.'</td>';
                        if($dERG->photo == NULL){
            $isi .='        <td>
                                <img src="'.asset('/uploads/NOPICTURE/no_picture.png').'" style="height:50px;width:60px;cursor:pointer;">
                            </td>';
                        }else{
            $isi .='        <td>
                                <img src="'.asset('/uploads/EVENT/'.$dERG->photo).'" style="height:50px;width:60px;cursor:pointer;">
                            </td>';
                        }
                $isi .='
                        <td> 
                            <button onclick="editReformasiGerejaModel(`'.$dERG->event_id.'`)" class="btn btn-warning text-white"> <i class="fas fa-pencil-alt"></i> </button>
                            <button onclick="deteleReformasiGereja(`'.$dERG->event_id.'`)" class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </button>
                        </td>   
                    </tr>
                ';
            }
        }
        $isi .= "###".$paginator->links('vendor.pagination.bootstrap-4-ajax');
        return $isi;
    }
}
