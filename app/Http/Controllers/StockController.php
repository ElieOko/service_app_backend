<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\StockHistoriqueEntree;
use App\Http\Resources\StockCollection;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock = Stock::with("article")->orderBy('id', 'desc')->get();
        if($stock->count() != 0 ){
            return new StockCollection($stock);
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
        $quantiteIncrement = 0;
        $state_save = false;
        $dt = json_decode($request->getContent());
        $check = Stock::where("article_fk",$dt->article_fk)->get();
        if(count($check)>0){
            foreach ($check as $item) {
                $quantiteIncrement = $item['quantiteEntree'] + $dt->quantiteEntree;
            }
            $stock = Stock::find((int)$check[0]->id);
            $update = ["quantiteEntree" => $quantiteIncrement];
            $state_save = $stock->update($update);
        }
        else{
            $state_save = Stock::create([
                "article_fk"  => $dt->article_fk,
                "quantiteEntree"  => $dt->quantiteEntree,
                "date_creation" => $day
            ]);
        }
            StockHistoriqueEntree::create([
                "article_fk"  => $dt->article_fk,
                "quantite"  => $dt->quantiteEntree,
            ]);    
            if(!$state_save){
                $msg = "Echec de l'enregistrement";
                $status = 400;
            } 
            return response()->json([
                "message"=>$msg,
            ],$status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
