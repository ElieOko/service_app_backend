<?php

namespace App\Http\Controllers;

use App\Models\Dette;
use App\Models\Stock;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\StockHistoriqueSortie;
use App\Http\Resources\DetteCollection;

class DetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Dette::with("stock.article","marketeur","type_vente","code","status")->orderBy('id', 'desc')->get();
        if($data->count() != 0 ){
            return new DetteCollection($data);
        }
        return response()->json([
            "message"=>"Ressource not found",
        ],400);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $msg = "Enregistrement réussie avec succès";
        $status = 201;
        $day    = date("d-m-Y H:i:s");
        $dt = json_decode($request->getContent());
        $stock = Stock::find($dt->stock_fk);
        $difQteDispo = $stock->quantiteEntree - $stock->quantiteSortie;
        $state_save = false;
        if($difQteDispo >= $dt->quantite_emprunter){
            $article    = Article::find($stock->article_fk);
            $price      = $dt->type_vente_fk == 1 ? $article->price_big : $article->prixUnitaire;
            // return response()->json([
            //     "montant "=>$article  ,
            //     "message"=>$msg,
            // ],$status);
            $prixTotal  = $dt->quantite_emprunter * $price; 
            $state_save = Dette::create([
                "code_fk"                   => $dt->code_fk,
                "stock_fk"                  => $dt->stock_fk,
                "quantite_emprunter"        => $dt->quantite_emprunter,
                "marketeur_fk"              => $dt->marketeur_fk,
                "note"                      => $dt->note?? "",
                "type_vente_fk"             => $dt->type_vente_fk,
                "date_creation"             => $day,
                "status_fk"                 => 1,
                "montant_final"             => $prixTotal
            ]);
            $stock = Stock::find($dt->stock_fk);
            $stock->update(["quantiteSortie"=> $stock->quantiteSortie + $dt->quantite_emprunter]);
            StockHistoriqueSortie::create([
                "quantite"  => $dt->quantite_emprunter,
                "stock_fk"  => $dt->stock_fk,
                "prixUnitaire" => $dt->type_vente_fk == 1 ? $article->price_big : $article->prixUnitaire ,
                "prixTotal"  => $prixTotal,
            ]);
            return response()->json([
                "dettes"=>Dette::with("code","stock.article","status","type_vente","marketeur")->where('code_fk',$dt->code_fk??0)->get(),
                "message"=>$msg,
            ],$status);
        }
        else{
            $msg = "Stock Insufisant pour la sortie de cette articles dans le stock";
            if($difQteDispo != 0){
                $msg .= " disponible $difQteDispo";
            }
            else{
                $msg = "Cette articles dans le stock est en rupture"; 
            }
            $status = 200;
        } 
            return response()->json([
                "message"=>$msg,
            ],$status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dette $dette)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dette $dette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dette $dette)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dette $dette)
    {
        //
    }
}
