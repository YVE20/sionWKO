<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pujianModel extends Model
{
    use HasFactory;
    protected $table = "tb_pujian";
    protected $primaryKey = "singing_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'singing_id','serviceCategory_id','singer','sermon_date','time','created_at','updated_at'
    ];
}
