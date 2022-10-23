<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataJemaatModel extends Model
{
    use HasFactory;
    protected $table = "tb_data_jemaat";
    protected $primaryKey = "congregation_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'congregation_id','baptism_id','sidi_id','familyCard_id','service_environtment','created_at','updated_at'
    ];
}
