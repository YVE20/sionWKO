<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kartuKeluargaModel extends Model
{
    use HasFactory;
    protected $table = "tb_kartu_keluarga";
    protected $primaryKey = "familyCard_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'familyCard_id','family_headName','address','RTRW','zipCode','photo','created_at','updated_at'
    ];
}
