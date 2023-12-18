<?php

namespace App\Models;

use App\Models\Article;
use App\Models\CodeStock;
use App\Models\Facturation;
use App\Models\StockHistoriqueEntree;
use App\Models\StockHistoriqueSortie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'article_fk',
        'quantiteEntree',
        'quantiteSortie'
    ];
    public function article()
    {
        return $this->belongsTo(Article::class,'article_fk','id');
    }
    public function stock_historique_entree(): HasMany
    {
        return $this->hasMany(StockHistoriqueEntree::class);
    }
    public function stock_historique_sortie(): HasMany
    {
        return $this->hasMany(StockHistoriqueSortie::class);
    }
    public function facturation(): HasMany
    {
        return $this->hasMany(Facturation::class);
    }
    public function code_stock(): HasMany
    {
        return $this->hasMany(CodeStock::class);
    }
}
