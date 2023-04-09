<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyLecturer extends Model
{
    use HasFactory;

    public $table = "verify_lecturers";

    protected $fillable = [
        'lecturer_id',
        'token',
    ];

    public function lecturer(){
        return $this->belongsTo(Lecturer::class);
    }
}
