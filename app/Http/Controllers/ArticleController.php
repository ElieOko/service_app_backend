<?php

namespace App\Http\Controllers;

use App\Models\Devise;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $article = Article::with("devise")->orderBy('id', 'desc')->get();
        if($article->count() != 0 ){
            return new ArticleCollection($article);
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
        $prix = $dt->prixUnitaire;
        if ( $dt->devise_fk == 1) {
           $devise = Devise::find(1);
           $prix =$devise->taux * $dt->prixUnitaire;
        }
        $state_save = Article::create([
                "nom"  => $dt->nom,
                "prixUnitaire" => $prix,
                "devise_fk" => 2
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
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
