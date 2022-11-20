<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Config;

class VehiculeController extends Controller
{
    // Listing
    public function list(){
        try{
            $q=Vehicule::get();
            return response([
                'success' => true,
                'data' => $q
            ]);
        }catch (\Exception $exception){
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 401);
        }
    }
    // Save
    public function save(Request $request){
        try{
            $q = new Vehicule;
            $vehicule_id = Helper::IDGenerator(new Vehicule, 'vehicule_id', Config::get('constants.ID_LENGTH'), Config::get('constants.PREFIX_VEHICULE'));
            if(isset($request->photo)){
              $q->photo_vehicule = Helper::CreateFile(Config::get('constants.URL_UPLOAD_VHL'), $request->photo_perso, Config::get('constants.PREFIX_VEHICULE'));
            }
            $q->vehicule_id=$vehicule_id;
            $q->type_carburant=$request->input('type_carburant');
            $q->fabricant=$request->input('fabricant');
            $q->annnee=$request->input('annnee');
            $q->plaque=$request->input('plaque');
            $q->type=$request->input('type');
            $q->plaque_expiration=$request->input('plaque_expiration');
            $q->couleur=$request->input('couleur');
            $q->num_moteur=$request->input('num_moteur');
            $q->fournisseur=$request->input('fournisseur');
            $q->date_acquisition=$request->input('date_acquisition');
            $q->valeur_a_acquisition=$request->input('valeur_a_acquisition');
            $q->odometre=$request->input('odometre');
            $q->type_odometre= $request->input('type_odometre');
            $q->note_vehicule=$request->input('note_vehicule');
            $q->etat_vehicule=$request->input('etat_vehicule');

            $q->save();
            return response([
                'success' => true,
                'data' => $q
            ]);
        }catch (\Exception $exception){
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 401);
        }

    }

    // Update
    public function update(Request $request, $id){
        try{
            $q=Vehicule::find($id);
            /*if(isset($request->photo)){
                $path=Config::get('constants.URL_UPLOAD_VHL');;
                $fileName='vhl_' . time() . '.'. $request->photo->extension();
                $request->photo->move(public_path($path), $fileName);
                $request->photo=$path.$fileName;
            }*/
            $q->update($request->all());

            return response([
                'success' => true,
                'data' => $q
            ]);
        }catch (\Exception $exception){
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 401);
        }

    }

    // Delete
    public function destroy($id)
    {
        try{
            $q=Vehicule::destroy($id);

            return response([
                'success' => true,
                'data' => $q
            ]);
        }catch (\Exception $exception){
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 401);
        }
    }
}
