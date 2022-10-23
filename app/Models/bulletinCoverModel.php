<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulletinCoverModel extends Model
{
    use HasFactory;
    protected $table = "tb_bulletin_cover";
    protected $primaryKey = "cover_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'cover_id','cover','month','theme','created_at','updated_at'
    ];
}
