<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockHistoriqueEntree;
use App\Http\Resources\StockHistoriqueEntreeCollection;

class StockHistoriqueEntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock = StockHistoriqueEntree::with("article")->orderBy('id', 'desc')->get();
        if($stock->count() != 0 ){
            return new StockHistoriqueEntreeCollection($stock);
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
        //
        $msg = "Enregistrement réussie avec succès";
        $status = 201;
        $dt = json_decode($request->getContent());
        $state_save = StockHistoriqueEntree::create([
                "article_fk"  => $dt->article_fk,
                "quantiteEntree"  => $dt->quantiteEntree,
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
    public function show(StockHistoriqueEntree $stockHistoriqueEntree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockHistoriqueEntree $stockHistoriqueEntree)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockHistoriqueEntree $stockHistoriqueEntree)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockHistoriqueEntree $stockHistoriqueEntree)
    {
        //
    }
}
