<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembagianMajelisModel extends Model
{
    use HasFactory;
    protected $table = "tb_pembagian_majelis";
    protected $primaryKey = "assemblyData_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'assemblyData_id','assembly_group','assembly_name','sermon_date','created_at','updated_at'
    ];

    public function group_data(){
        return $this->hasMany('App\Models\pembagianMajelisModel','assembly_group','assembly_group');
    }
}
