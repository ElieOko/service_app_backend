<?php

namespace App\Http\Controllers;

use App\Models\Marketeur;
use Illuminate\Http\Request;
use App\Http\Resources\MarketeurCollection;

class MarketeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mark = Marketeur::all();
        if($mark->count() != 0 ){
            return new MarketeurCollection($mark);
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
        $dt = json_decode($request->getContent());
        $state_save = Marketeur::create([
                "nom"  => $dt->nom,
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
    public function show(Marketeur $marketeur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marketeur $marketeur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marketeur $marketeur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marketeur $marketeur)
    {
        //
    }
}
