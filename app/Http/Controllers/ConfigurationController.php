<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Http\Requests\StoreConfigRequest;


class ConfigurationController extends Controller
{
    public function index(){

        $allConfigurations = Configuration::latest()->paginate(10);
        return view('config.index', compact('allConfigurations'));
    }
    public function create(){
        return view('config.create');
    }
    public function store(StoreConfigRequest $request){
        try{

            Configuration::create($request->all());
            return redirect()->route('configurations')->with('success_message', 'configuration ajouté');
        }catch (Exception $e){
            throw new Exception('Erreur lors de l\'enregistrement de la configuration');
        }

    }

    public function delete(Configuration $configuration){
        try{
            $configuration -> delete();
            return redirect()->route('configurations')->with('success_message', 'configuration a été supprimé');
        }catch(Exception $e){
            throw new Exception('Erreur lors de la suppression à la configuration');
        }
    }
}
