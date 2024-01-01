<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHistoriqueSortie extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_fk',
        'quantite',
        'prixUnitaire',
        'prixTotal',
        'date_creation'
    ];
    public function stock()
    {
        return $this->belongsTo(Stock::class,'stock_fk','id');
    }
}
