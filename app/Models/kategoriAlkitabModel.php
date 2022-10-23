<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriAlkitabModel extends Model
{
    use HasFactory;
    protected $table = "tb_kategori_alkitab";
    protected $primaryKey = "bibleCategory_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'bibleCategory_id','bible','isChanged','created_at','updated_at'
    ];
}
