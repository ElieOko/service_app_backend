<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\Devise;
use App\Models\TypeArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prixUnitaire',
        'devise_fk',
        'price_big',
        'type_article_fk',
        'price_usd_short',
        'price_usd_big',
    ];
    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
    public function devise()
    {
        return $this->belongsTo(Devise::class,'devise_fk','id');
    }
    public function type_article()
    {
        return $this->belongsTo(TypeArticle::class,'type_article_fk','id');
    }
}
