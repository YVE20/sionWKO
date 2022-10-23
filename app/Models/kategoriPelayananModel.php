<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriPelayananModel extends Model
{
    use HasFactory;
    protected $table = "tb_kategori_pelayanan";
    protected $primaryKey = "serviceCategory_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'serviceCategory_id','service','created_at','updated_at'
    ];
}
