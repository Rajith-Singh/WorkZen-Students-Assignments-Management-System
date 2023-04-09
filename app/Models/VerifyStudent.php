<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyStudent extends Model
{
    use HasFactory;

    public $table = "verify_students";

    protected $fillable = [
        'student_id',
        'token',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
