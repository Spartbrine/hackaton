<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysistest extends Model
{
    use HasFactory;

    protected $table = 'analysistest';

    protected $fillable = [
        'idtest',
        'idquestion',
        'idanswer',
        'email'
    ];

    public function email (){
        // $this->hasOne(Category::class, 'id', 'category_id'); Incorrecto
        return $this->belongsTo(Users::class, 'email'); //Para belongsTo unicamente es el campo con el que se debe buscar
    }

    public function idquestion (){
        // $this->hasOne(Category::class, 'id', 'category_id'); Incorrecto
        return $this->belongsTo(Question::class, 'idquestion'); //Para belongsTo unicamente es el campo con el que se debe buscar
    }

    public function idanswer (){
        // $this->hasOne(Category::class, 'id', 'category_id'); Incorrecto
        return $this->belongsTo(Answer::class, 'idanswer'); //Para belongsTo unicamente es el campo con el que se debe buscar
    }
}
