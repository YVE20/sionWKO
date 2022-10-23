<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ibadahModel extends Model
{
    use HasFactory;
    protected $table = "tb_ibadah";
    protected $primaryKey = "worship_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'worship_id','category_id','speaker','sermon_title','sermon_content','place','sermon_date','time','speaker_contact','service_environtment','created_at','updated_at'
    ];
}
