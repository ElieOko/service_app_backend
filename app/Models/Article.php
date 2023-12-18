<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\Devise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prixUnitaire',
        'devise_fk',
    ];
    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
    public function devise()
    {
        return $this->belongsTo(Devise::class,'devise_fk','id');
    }
}
