<?php

namespace App\Models;

use App\Models\Dette;
use App\Models\Stock;
use App\Models\CodeStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Code extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom'
    ];
    public function code_stock(): HasMany
    {
        return $this->hasMany(CodeStock::class);
    }
    public function dette(): HasMany
    {
        return $this->hasMany(Dette::class);
    }
}
