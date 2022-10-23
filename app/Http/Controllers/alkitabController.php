<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class alkitabController extends Controller
{
    //Kategori Alkitab
    public function createKategoriAlkitab(){
        return "createKategoriAlkitab";
    }
    public function readKategoriAlkitab(){
        return "readKategoriAlkitab";
    }
    public function updateKategoriAlkitab(){
        return "updateKategoriAlkitab";
    }
    public function deleteKategoriAlkitab(){
        return "deleteKategoriAlkitab";
    }
    //Alkitab
    public function createAlkitab(){
        return "createAlkitab";
    }
    public function readAlkitab(){
        return "readAlkitab";
    }
    public function updateAlkitab(){
        return "updateAlkitab";
    }
    public function deleteAlkitab(){
        return "deleteAlkitab";
    }
}
