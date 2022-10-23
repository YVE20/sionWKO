<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penerimaTamuModel extends Model
{
    use HasFactory;
    protected $table = "tb_penerima_tamu";
    protected $primaryKey = "welcoming_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'welcoming_id','serviceCategory_id','welcomer','sermon_date','time','created_at','updated_at'
    ];
}
