<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    protected $fillable = [
        'description',
        'email'
    ];

    public function email (){
        // $this->hasOne(Category::class, 'id', 'category_id'); Incorrecto
        return $this->belongsTo(users::class, 'email'); //Para belongsTo unicamente es el campo con el que se debe buscar
    }

}
