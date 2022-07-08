<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\ClientStatus;
use App\Models\Intermediaire;
use App\Models\LocalCommercial;
use App\Models\LocalCommercialService;
use Illuminate\Http\Request;

class LocalCommercialController extends Controller
{

    public function index()
    {
        return view('amrani.pages.lc.index')->with([
            'locals'            =>  LocalCommercial::all(),
            'services'          =>  LocalCommercialService::all(),
            'cities'            =>  City::all(),
            'situations'        =>  LocalCommercial::SITUATIONS,
        ]);
    }


    public function create()
    {
        $client = new ClientController;
        $lastID = 'LC' . (LocalCommercial::max('id') + 1);
        return view('amrani.pages.lc.create')->with([
            'code_client'           =>  $client->newCodeClient(),
            'client_categories'     =>  ClientCategory::all(),
            'client_statuses'       =>  ClientStatus::all(),
            'services'              =>  LocalCommercialService::all(),
            'cities'                =>  City::all(),
            'facades'               =>  LocalCommercial::FACADES,
            'etats'                 =>  LocalCommercial::ETATS,
            'situations'            =>  LocalCommercial::SITUATIONS,
            'projets'               =>  LocalCommercial::PROJETS,
            'details'               =>  LocalCommercial::DETAILS,
            'lc_code'               =>  $lastID
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lc_code'              => 'required|max:10',
            'client_name'          => 'required|string|max:255',
            'lc_service_id'         => 'required|integer|min:1'
        ]);
        $contacts = [];
        foreach($request->client_contact_name as $k=>$contact){
            if($contact){
                $contacts[] = [
                    "name"          =>  $contact,
                    "telephone"     =>  isset($request->client_contact_telephone[$k])? $request->client_contact_telephone[$k]:''
                ];               
            }

        }
        if($request->is_intermediaire){
            if(!$request->intermediaire_id){
                $intermediaireTemp = new IntermediaireController;
                $intermediaire = Intermediaire::create([
                    'intermediaire_name'            =>  $request->client_name,
                    'intermediaire_telephone'          =>  $request->client_telephone? $request->client_telephone: "",
                    'intermediaire_code'           =>  $intermediaireTemp->newCodeIntermediaire(),
                    'intermediaire_category_id'    =>  $intermediaireTemp->getDefaultIntermediaireCategory(),
                    'intermediaire_status_id'    =>  $intermediaireTemp->getDefaultIntermediaireStatus(),
                    'contacts'      =>  json_encode($contacts)
                ]);
                $request->merge([
                    'intermediaire_id' =>  $intermediaire->id
                ]);
            }  
        }else{
            if(!$request->client_id){
                $clientTemp = new ClientController;
                $client = Client::create([
                    'client_name'            =>  $request->client_name,
                    'client_telephone'          =>  $request->client_telephone? $request->client_telephone: "",
                    'client_code'           =>  $clientTemp->newCodeClient(),
                    'client_category_id'    =>  $clientTemp->getDefaultClientCategory(),
                    'client_status_id'    =>  $clientTemp->getDefaultClientStatus(),
                    'contacts'      =>  json_encode($contacts)
                ]);
                $request->merge([
                    'client_id' =>  $client->id
                ]);
            }            
        }

        $request->merge([
            'lc_projets'    =>  isset($request->lc_projets)? json_encode($request->lc_projets): '',
            'lc_details'    =>  isset($request->lc_details)? json_encode($request->lc_details): '',
            'city_id' => $request->city_id? $request->city_id:-1,
            'city_sector_id' => $request->city_sector_id? $request->city_sector_id:-1,
        ]);
        LocalCommercial::create($request->all());
        return redirect()->route('lc.index');
    }


    public function show(LocalCommercial $localCommercial)
    {
        //
    }

    public function edit(LocalCommercial $lc)
    {
        try {
            return view('amrani.pages.lc.edit')->with([
                'client_categories'     =>  ClientCategory::all(),
                'client_statuses'       =>  ClientStatus::all(),
                'services'              =>  LocalCommercialService::all(),
                'cities'                =>  City::all(),
                'facades'               =>  LocalCommercial::FACADES,
                'etats'                 =>  LocalCommercial::ETATS,
                'situations'            =>  LocalCommercial::SITUATIONS,
                'projets'               =>  LocalCommercial::PROJETS,
                'details'               =>  LocalCommercial::DETAILS,
                'lc'                    =>  $lc
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public function update(Request $request, LocalCommercial $lc)
    {
        $request->validate([
            'lc_code'                   => 'required|max:10',
            'client_name'               => 'required|string|max:255'
        ]);
        $request->merge([
            'lc_projets'    =>  isset($request->lc_projets)? json_encode($request->lc_projets): '',
            'lc_details'    =>  isset($request->lc_details)? json_encode($request->lc_details): '',
            'city_id' => $request->city_id? $request->city_id:-1,
            'city_sector_id' => $request->city_sector_id? $request->city_sector_id:-1,
        ]);
        $lc->update($request->all());
        return redirect()->route('lc.index');
    }

    public function destroy(LocalCommercial $lc)
    {
        $lc->delete();
        return redirect()->route('lc.index');
    }
}
