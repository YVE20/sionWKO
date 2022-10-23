<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function createUser(){
        return "createUser";
    }
    public function readUser(){
        return "readUser";
    }
    public function updateUser(){
        return "updateUser";
    }
    public function deleteUser(){
        return "deleteUser";
    }
}
