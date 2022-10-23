<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penataanBungaModel extends Model
{
    use HasFactory;
    protected $table = "tb_penataan_bunga";
    protected $primaryKey = "flowerArrangement_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'flowerArrangement_id','serviceCategory_id','mothersOnDuty','coordinator','sermon_date','time','created_at','updated_at'
    ];
}
