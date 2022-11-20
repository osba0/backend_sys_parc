<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Personnel;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Config;

class PersonnelController extends Controller
{
    // Listing
    public function list(){
        try{
            $q=Personnel::get();
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
    public function save(Request $request)
    {
        try {
            $q = new Personnel;
            $personnel_id = Helper::IDGenerator(new Personnel, 'personnel_id', Config::get('constants.ID_LENGTH'), Config::get('constants.PREFIX_PERSONNEL'));
            if (isset($request->photo_perso)) {
                $q->photo_perso = Helper::CreateFile(Config::get('constants.URL_UPLOAD_PER'), $request->photo_perso, Config::get('constants.PREFIX_PERSONNEL'));
            }
            $q->personnel_id = $personnel_id;
            $q->nom_perso = $request->input('nom_perso');
            $q->prenom_perso = $request->input('prenom_perso');
            $q->telephone1_perso = $request->input('telephone1_perso');
            $q->telephone2_perso = $request->input('telephone2_perso');
            $q->contact_urgence_perso = $request->input('contact_urgence_perso');
            $q->email_perso = $request->input('email_perso');
            $q->poste_perso = $request->input('poste_perso');
            $q->adresse_perso = $request->input('adresse_perso');
            $q->departement_perso = $request->input('departement_perso');
            $q->region_perso = $request->input('region_perso');
            $q->date_naissance_perso = $request->input('date_naissance_perso');
            $q->date_embauche_perso = $request->input('date_embauche_perso');
            $q->salaire_horaire_perso = $request->input('salaire_horaire_perso');
            $q->note_perso = $request->input('note_perso');

            $q->save();
            return response([
                'success' => true,
                'data' => $q
            ]);
        } catch (\Exception $exception) {
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 401);
        }
    }
    // Update
    public function update(Request $request, $id){
        try{
            $q=Personnel::find($id);

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
            $q=Personnel::destroy($id);

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
