<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'test';

    protected $fillable = [
        'id',
        'quiestion',
    	'option1',
        'option2',
        'option3',
        'option4',
        'option5'	
    ];
}
