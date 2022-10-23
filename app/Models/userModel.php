<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    use HasFactory;
    protected $table = "tb_user";
    protected $primaryKey = "user_id";
    public $incrementing = true;
    public $timestamps = true;
    public $fillable = [
        'user_id','name','email','username','phone','password','gender','picture','level','status','remember_token','created_at','updated_at'
    ];
}
