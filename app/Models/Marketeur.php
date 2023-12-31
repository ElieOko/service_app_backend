<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketeur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom'
    ];
}
