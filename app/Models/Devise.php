<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'code',
        'taux',
    ];
    public function article(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
