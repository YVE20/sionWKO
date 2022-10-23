<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rapatEvaluasiModel extends Model
{
    use HasFactory;
    protected $table = "tb_rapat_evaluasi";
    protected $primaryKey = "evaluationMeeting_id";
    public $incrementing = false;
    public $timestamps = true;
    public $fillable = [
        'evaluationMeeting_id','evaluationMeeting','place','date','time','created_at','updated_at'
    ];
}
