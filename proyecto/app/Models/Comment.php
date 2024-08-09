<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    protected $fillable = [
        'id',
        'description',
        'email',
        'publication_id'
    ];

    public function email (){

        return $this->belongsTo(Users::class, 'email');
    }

    public function publication (){
        return $this->belongsTo(Publication::class, 'publication_id');
    }


}
