<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventModel extends Model
{
    use HasFactory;
    protected $table = "tb_event";
    protected $primaryKey = "event_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'event_id','eventCategory_id','speaker','place','sermon_date','address','theme','contact_person','photo','time','created_at','updated_at'
    ];
}
