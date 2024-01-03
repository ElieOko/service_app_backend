<?php

namespace App\Models;

use App\Models\Dette;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeVente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom'
    ];
    public function dette(): HasMany
    {
        return $this->hasMany(Dette::class);
    }
}
