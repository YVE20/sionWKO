<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataBaptisModel extends Model
{
    use HasFactory;
    protected $table = "tb_data_baptis";
    protected $primaryKey = "baptism_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'baptism_id','full_name','gender','place_ofBirth','date_ofBirth','date_ofBaptism','religion','church','father_name','mother_name','address','pastor','photo','created_at','updated_at'
    ];
}
