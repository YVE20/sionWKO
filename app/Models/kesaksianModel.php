<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kesaksianModel extends Model
{
    use HasFactory;
    protected $table = "tb_kesaksian";
    protected $primaryKey = "testimony_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'testimony_id','name','email','subject','message','created_at','updated_at'
    ];
}
