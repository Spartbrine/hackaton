<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychological extends Model
{
    use HasFactory;

    protected $table = 'psychological';

    protected $fillable = [
        'name',
        'lastname',
        'professional_cell',
        'whatsapp_link',
        'review'
    ];
}
