<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';

    protected $fillable = [
        'id',
        'type',
        'email',
        'read'
    ];

    public function email (){
        // $this->hasOne(Category::class, 'id', 'category_id'); Incorrecto
        return $this->belongsTo(Users::class, 'email'); //Para belongsTo unicamente es el campo con el que se debe buscar
    }

}
