<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeArticle extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom'
    ];
    public function article(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
