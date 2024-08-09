<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysistest extends Model
{
    use HasFactory;

    protected $table = 'analysistest';

    protected $fillable = [
        'id',
        'question',
        'answer',
        'email'
    ];
}
