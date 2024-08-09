<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psychological extends Model
{
    use HasFactory;

    protected $table = 'psychological';

    protected $fillable = [
        'email',
        'professional_cell',
        'whatsapp_link'
    ];

    public function email (){
        // $this->hasOne(Category::class, 'id', 'category_id'); Incorrecto
        return $this->belongsTo(Users::class, 'email'); //Para belongsTo unicamente es el campo con el que se debe buscar
    }

}
