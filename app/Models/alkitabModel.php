<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alkitabModel extends Model
{
    use HasFactory;
    protected $table = "tb_alkitab";
    protected $primaryKey = "bible_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'bible_id','bibleCategory_id','title','book','paragraph','chapter','description','created_at','updated_at'
    ];
}
