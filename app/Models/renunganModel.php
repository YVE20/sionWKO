<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class renunganModel extends Model
{
    use HasFactory;
    protected $table = "tb_renungan";
    protected $primaryKey = "reflection_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'reflection_id','reflection_title','bible_verse','verse','contens','created_at','updated_at'
    ];
}
