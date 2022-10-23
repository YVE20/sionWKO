<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataSIDIModel extends Model
{
    use HasFactory;
    protected $table = "tb_data_sidi";
    protected $primaryKey = "sidi_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'sidi_id','full_name','gender','place_ofBirth','date_ofBirth','NIK','baptism_file','date_ofBaptism','church','father_name','mother_name','address','marriage_certificate','photo','phone_number','date_ofSIDI','created_at','updated_at'
    ];
}
