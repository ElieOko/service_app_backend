<?php

namespace App\Http\Controllers;

use App\Models\Devise;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\DeviseCollection;

class DeviseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devise = Devise::all();
        if($devise->count() != 0 ){
            return new DeviseCollection($devise);
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
        $state_save = Devise::create([
                "nom"  => $dt->nom,
                'taux' => $dt->taux,
                'code' => $dt->code,
            ]);
       
            return response()->json([
                "message"=>$msg,
            ],$status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Devise $devise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
        $dt = json_decode($request->getContent());
        $update_data = Devise::find(1);
        $update_data->update([
            'taux' => $dt->taux
        ]);
        $msg = "Enregistrement réussie avec succès";
        $status = 201;
        $article = Article::all();
        foreach ($article as $item) {
            $data = Article::find($item->id);
            $state_change = [
                "price_big"=> $data->price_usd_big * $update_data->taux,
                "prixUnitaire"=>$data->price_usd_short * $update_data->taux
            ];
            $data->update($state_change);
        }
        return response()->json([
            "message"=>$msg,
        ],$status);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Devise $devise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Devise $devise)
    {
        //
    }
}
