<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriIbadahModel extends Model
{
    use HasFactory;
    protected $table = "tb_kategori_ibadah";
    protected $primaryKey = "category_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'category_id','category','created_at','updated_at'
    ];
}
