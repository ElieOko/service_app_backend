<?php

namespace App\Models;

use App\Models\Code;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CodeStock extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_fk',
        'code_fk'
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
