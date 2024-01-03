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
        $article = Article::with("devise","type_article")->orderBy('id', 'desc')->get();
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
        $msg            = "Enregistrement réussie avec succès";
        $status         = 201;
        $request->validate([
            'nom' => 'required|string|unique:articles,nom'
            ]);
        $dt             = json_decode($request->getContent());
        $prix           = $dt->prixUnitaire;
        $price          = $dt->price_big;
        $usd_short      = 0;
        $usd_big        = 0;
        $devise         = Devise::find(1);
        if($dt->devise_fk == 1) {
           $usd_short   = $prix ;
           $usd_big     = $price ;
           $prix        = $devise->taux * $dt->prixUnitaire;
           $price       = $devise->taux * $dt->price_big;
        }
        else{
            $usd_short  = $dt->prixUnitaire / $devise->taux;
            $usd_big    = $dt->price_big    / $devise->taux;
        }
        $state_save = Article::create([
                "nom"               => $dt->nom,
                "prixUnitaire"      => $prix,
                "devise_fk"         => 2,
                "price_big"         => $price,
                "type_article_fk"   => $dt->type_article_fk,
                "price_usd_short"   => $usd_short,
                "price_usd_big"     => $usd_big
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
    public function update(Request $request, int $id)
    {
        $dt                 = json_decode($request->getContent());
        $article            = Article::find($id);
        $current_cloture    = date("Y-m-d H:i:s");
        $devise             = Devise::find(1);
        $short_usd          = 0;
        $prix               = 0;
        $big_usd            = 0;
        $price              = 0;
        if($dt->prixUnitaire > 0){
            $prix       =  $dt->prixUnitaire;
            $short_usd  = $dt->prixUnitaire / $devise->taux;
        }
        else{
            $prix       = $devise->taux * $dt->price_usd_short;
        }
        if($dt->price_big > 0) {
            $price      = $dt->price_big;
            $big_usd    = $dt->price_big / $devise->taux;
        }
        else{
            $price      = $devise->taux * $dt->price_usd_big;
        }
        $update_data    = [
            "price_usd_short"   => $short_usd,
            "price_usd_big"     => $big_usd,
            "nom"               => $dt->nom,
            "prixUnitaire"      => $prix,
            "price_big"         => $price 
        ];
        $article->update($update_data);
        $response =[
            'message'   =>  "Success"
        ];
        return response($response,201);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
