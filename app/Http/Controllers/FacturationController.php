<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Article;
use App\Models\Facturation;
use Illuminate\Http\Request;
use App\Models\StockHistoriqueSortie;
use App\Http\Resources\FacturationCollection;

class FacturationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturation = Facturation::with("stock.article","code")->orderBy('id', 'desc')->get();
        if($facturation->count() != 0 ){
            return new FacturationCollection($facturation);
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
        
        if($difQteDispo >= $dt->quantite){
            $article    = Article::find($stock->article_fk);
            $price      = $dt->type_vente_fk == 1 ? $article->price_big : $article->prixUnitaire;
            $prixTotal  = $dt->quantite * $price; 
            $state_save = Facturation::create([
                "code_fk"       => $dt->code_fk,
                "stock_fk"      => $dt->stock_fk,
                "quantite"      => $dt->quantite,
                "prixTotal"     => $prixTotal,
                "type_vente_fk" => $dt->type_vente_fk,
                "date_creation" => $day
            ]);

            $stock = Stock::find($dt->stock_fk);
            $stock->update(["quantiteSortie"=> $stock->quantiteSortie + $dt->quantite]);
            StockHistoriqueSortie::create([
                "quantite"      => $dt->quantite,
                "stock_fk"      => $dt->stock_fk,
                "prixUnitaire"  => $price ,
                "prixTotal"     => $prixTotal,
            ]);
            return response()->json([
                "facturation"=>Facturation::with("code","stock.article")->where('code_fk',$dt->code_fk??0)->get(),
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
    public function cancel_facturation($id){
        
    }
    public function show(Facturation $facturation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facturation $facturation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facturation $facturation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facturation $facturation)
    {
        //
    }
}
