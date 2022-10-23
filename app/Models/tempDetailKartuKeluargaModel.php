<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempDetailKartuKeluargaModel extends Model
{
    use HasFactory;
    protected $table = "tb_temp_dtl_kartu_keluarga";
    protected $primaryKey = "number";
    public $incrementing = true;
    public $timestamps = true;
    public $fillable = [
        'number','familyCard_id','fullName','NIK','gender','place_ofBirth','date_ofBirth','religion','education','job','blood','marriage','date_ofMarriage','family_status','citizenship','paspor','fatherName','motherName','created_at','updated_at'
    ];
}
