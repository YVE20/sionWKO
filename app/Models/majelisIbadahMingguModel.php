<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class majelisIbadahMingguModel extends Model
{
    use HasFactory;
    protected $table = "tb_majelis_ibadah_minggu";
    protected $primaryKey = "assembly_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'assembly_id','serviceCategory_id','assembly','coordinator','khadim_companion','uniform','sermon_date','time','created_at','updated_at'
    ];
}
