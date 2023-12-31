<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
