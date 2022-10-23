<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class khadimModel extends Model
{
    use HasFactory;
    protected $table = "tb_khadim";
    protected $primaryKey = "khadim_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'khadim_id','serviceCategory_id','theme','khadim','sermon_date','time','created_at','updated_at'
    ];
}
