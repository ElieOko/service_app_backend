<?php

namespace App\Http\Controllers;

use App\Models\Signal;
use Illuminate\Http\Request;
use App\Http\Resources\SignalCollection;

class SignalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signal = Signal::all();
        if($facturation->count() != 0 ){
            return new SignalCollection($facturation);
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
        $state_save = Signal::create([
                "typeSignal"  => $dt->typeSignal,
                "description"  => $dt->description,
                "user_fk" => $dt->user_fk
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
    public function show(Signal $signal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Signal $signal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Signal $signal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Signal $signal)
    {
        //
    }
}
