<?php

namespace App\Http\Controllers;

use App\Models\Cluster;
use App\Models\Commune;
use App\Models\Filiere;
use App\Models\Village;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Arrondissement;
use Illuminate\Support\Facades\Storage;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clusters = Cluster::orderBy('nomCluster','ASC')->get();
        // Vérifier si utiliseateur connecter et rediriger
        // if (auth()->guest()) {
        //     return redirect('/login');
        // }
        // else
        return view('components.cluster.cluster',['clusters' => $clusters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filieres = Filiere::all();
        $departements = Departement::all();
        $communes = Commune::all();
        $arrondissements = Arrondissement::all();
        $villages = Village::all();
        return view('components.cluster.form',[
            'filieres'=>$filieres,
            'departements' => $departements,
            'communes' => $communes,
            'arrondissements' => $arrondissements,
            'villages' => $villages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //php artisan storage:link
        $chemin_image = Storage::disk('public')->put('clusters', $request->imgCluster);

        Cluster::create([
            "nomCluster" => $request->nomCluster,
            "imgCluster" => $chemin_image,
            "filiere_id" => $request->filiere,
            "village_id" => $request->village,
        ]);

        return redirect(route('cluster.home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cluster = Cluster::find($id);
        return view('components.cluster.show',['cluster'=>$cluster]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filieres = Filiere::all();
        $departements = Departement::all();
        $communes = Commune::all();
        $arrondissements = Arrondissement::all();
        $villages = Village::all();
        $cluster = Cluster::find($id);
        return view('components.cluster.form',[
            'cluster'=>$cluster,
            'filieres'=>$filieres,
            'departements' => $departements,
            'communes' => $communes,
            'arrondissements' => $arrondissements,
            'villages' => $villages
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cluster = Cluster::find($id);

        if ($request->has("imgCluster")) {
            //On supprime l'ancienne image
            Storage::delete($cluster->imgCluster);

            $chemin_image = Storage::disk('public')->put('clusters', $request->imgCluster);
        }

        // 3. On met à jour les informations du Post
        $cluster->update([
            "nomCluster" => $request->nomCluster,
            "imgCluster" => isset($chemin_image) ? $chemin_image : $cluster->imgCluster,
            "filiere_id" => $request->filiere,
            "village_id" => $request->village
        ]);

        return redirect(route('cluster.home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cluster  $cluster
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cluster = Cluster::find($id);
        Storage::delete($cluster->imgCluster);
        $cluster->delete();

        return redirect(route('cluster.home'));
    }

    public function select_option( $array ){
        $option = '';
            foreach ($array as $key => $value) {
                $option .= "<option value='". $value ."'>". $key . "</option>";
            }
        return $option;
    }

    public function getCommune($id){
        $communes = Commune::where('departement_id',$id)->get()->pluck('id','nomCommune')->toArray();
        return "<option selected>Selectionner une commune</option>" .$this->select_option($communes);
    }
    public function getArrondissement($id){
        $arrondissements = Arrondissement::where('commune_id',$id)->get()->pluck('id','nomArrondissement')->toArray();
        return "<option selected>Selectionner un Arrondissement</option>" . $this->select_option($arrondissements);
    }
    public function getVillage($id){
        $villages = Village::where('arrondissement_id',$id)->get()->pluck('id','nomVillage')->toArray();
        return "<option selected>Selectionner un village</option>" .$this->select_option($villages);
    }

}
