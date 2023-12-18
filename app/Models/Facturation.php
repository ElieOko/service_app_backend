<?php

namespace App\Models;

use App\Models\Code;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facturation extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_fk',
        'stock_fk',
        'quantite',
        'prixTotal',
        'status'
    ];
    public function stock()
    {
        return $this->belongsTo(Stock::class,'stock_fk','id');
    }
    public function code()
    {
        return $this->belongsTo(Code::class,'code_fk','id');
    }
}
