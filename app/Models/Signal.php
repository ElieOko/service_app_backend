<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Signal extends Model
{
    use HasFactory;
    protected $fillable = [
        'typeSignal',
        'description',
        'user_fk'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_fk','id');
    }

}
