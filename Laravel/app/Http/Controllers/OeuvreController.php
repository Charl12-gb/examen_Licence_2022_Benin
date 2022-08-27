<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use App\Models\Artiste;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OeuvreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oeuvres = Oeuvre::all();
        return view('components.liste', ['oeuvres' => $oeuvres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categorie::all();
        $artistes = Artiste::all();
        return view('components.form', ['categories' => $categories, 'artistes' => $artistes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chemin_image = Storage::disk('public')->put('oeuvres', $request->image);

        $oeuvre = new Oeuvre();
        $oeuvre->nom = $request->nom;
        $oeuvre->description = $request->description;
        $oeuvre->artiste_id = $request->artiste;
        $oeuvre->categorie_id = $request->categorie;
        $oeuvre->annee = $request->annee;
        $oeuvre->image = $chemin_image;
        $status = $oeuvre->save();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Ouevre Enrégistré avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur lors de l\'enregistrement'];
        return redirect()->route('oeuvre')->with($parametre);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Oeuvre  $oeuvre
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $oeuvre = Oeuvre::find($id);
        return view('components.show', ['oeuvre' => $oeuvre]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Oeuvre  $oeuvre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categorie::all();
        $artistes = Artiste::all();
        $oeuvre = Oeuvre::find($id);
        return view('components.form', ['categories' => $categories, 'artistes' => $artistes, 'oeuvre' => $oeuvre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Oeuvre  $oeuvre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oeuvre = Oeuvre::find($id);

        if ($request->has("image")) {
            //On supprime l'ancienne image
            Storage::delete($oeuvre->image);

            $chemin_image = Storage::disk('public')->put('oeuvres', $request->image);
        }

        // 3. On met à jour les informations du Post
        $status = $oeuvre->update([
            "nom" => $request->nom,
            "description" => $request->description,
            "annee" => $request->annee,
            "image" => isset($chemin_image) ? $chemin_image : $oeuvre->image,
            "categorie_id" => $request->categorie,
            "artiste_id" => $request->artiste
        ]);

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Oeuvre mise à jour avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur de mise à jour'];
        return redirect()->route('oeuvre')->with($parametre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Oeuvre  $oeuvre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oeuvre = Oeuvre::find($id);
        Storage::delete($oeuvre->image);
        $status = $oeuvre->delete();

        if( $status ) $parametre = ['status'=>true, 'msg'=>'Oeuvre Supprimé avec succès'];
        else $parametre = ['status'=>false, 'msg'=>'Erreur de suppression de l\'oeuvre'];
        return redirect()->route('oeuvre')->with($parametre);
    }
}
