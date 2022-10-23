<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    //Kategori Login
    public function createLogin(){
        return "createLogin";
    }
    public function readLogin(){
        return view('/Login/index');
    }
    public function updateLogin(){
        return "updateLogin";
    }
    public function deleteLogin(){
        return "deleteLogin";
    }
    public function cekLogin(){
        $all_data_user = userModel::get();
        if(count($all_data_user)){
            session_start();
            if($all_data_user[0]['email'] == $_POST['email'] && Hash::check($_POST['password'],$all_data_user[0]['password'])){
                if($all_data_user[0]['level'] == "Admin"){
                    $_SESSION['username'] = $all_data_user[0]['username'];
                    Session::put('username',$all_data_user[0]['username']);
                    return redirect('/adm/dashboard')->with('message','Welcome');
                }else{
                    return redirect('/');
                }
            }
            return redirect()->back()->with(["status"=>"Percobaan login belum berhasil", "judul_alert" => "Gagal" , "icon" => "warning"]);
        }else{
            return redirect()->back()->with(["status"=>"Percobaan login belum berhasil", "judul_alert" => "Gagal" , "icon" => "warning"]);
        }
    }
    public function cekPassword(Request $request){
        $akun = userModel::where('username',$request->session()->get('username'))->get();
        if(Hash::check($request->password,$akun[0]->password)){
            return "LOGIN";
        }else{
            return "FAILED";
        }
    }
    public function signOut(){
        Session::flush();
        return redirect('/');
    }
    
}
