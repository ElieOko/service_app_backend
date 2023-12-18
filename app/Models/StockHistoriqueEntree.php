<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockHistoriqueEntree extends Model
{
    use HasFactory;
    protected $fillable = [
        'article_fk',
        'quantite'
    ];
    public function article()
    {
        return $this->belongsTo(Article::class,'article_fk','id');
    }
}
