<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriEventModel extends Model
{
    use HasFactory;
    protected $table = "tb_kategori_event";
    protected $primaryKey = "eventCategory_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'eventCategory_id','event','created_at','updated_at'
    ];
}
