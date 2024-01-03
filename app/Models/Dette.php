<?php

namespace App\Models;

use App\Models\Code;
use App\Models\Stock;
use App\Models\Status;
use App\Models\Marketeur;
use App\Models\TypeVente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dette extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_fk',
        'stock_fk',
        'marketeur_fk',
        'type_vente_fk',
        'quantite_emprunter',
        'quantite_restante',
        'quantite_vendu',
        'montant_final',
        'montant_restant',
        'montant_payer',
        'status_fk',
        'note',
        'observation',
        'date_creation'
    ];
    public function stock()
    {
        return $this->belongsTo(Stock::class,'stock_fk','id');
    }
    public function marketeur()
    {
        return $this->belongsTo(Marketeur::class,'marketeur_fk','id');
    }
    public function type_vente()
    {
        return $this->belongsTo(TypeVente::class,'type_vente_fk','id');
    }
    public function code()
    {
        return $this->belongsTo(Code::class,'code_fk','id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class,'status_fk','id');
    }
}
