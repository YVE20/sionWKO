<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemusikModel extends Model
{
    use HasFactory;
    protected $table = "tb_pemusik";
    protected $primaryKey = "musician_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'musician_id','serviceCategory_id','projector','infocus','keyboard','prokantor','sermon_date','time','created_at','updated_at'
    ];
}
