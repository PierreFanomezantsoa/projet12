<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class medicineController extends Controller
{
    public function index(){
        $medicines=medicine::all();
        if($medicines ->count() >  0){
            return response()->json([
                'status'=>200,
                'medicines'=>$medicines
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Ne pas accede a la page'
            ],404); 
        }
       
    }
    public function store(Request $request){
        $valid=Validator::make($request->all(),[
            'nom' =>'required|String|max:191',
            'jour' =>'required|Integer',
            'taux' =>'required|Integer',
        ]);
        if($valid->fails()){
            return response()->json([
                'status' =>422,
                'errors' =>$valid->message()
            ],422);
        }
        else{
            $medicine=medicine::create([
                'nom' =>$request->nom,
                'jour' =>$request->jour,
                'taux' =>$request->taux,
            ]);
            if($medicine ){
                return response()->json([
                    'status'=>200,
                    'message'=>"student create success"
                ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"Desole les champs sont vide ! !"
                ],500); 
            }
        }
    }
    public function store1($id){
        $medicine=medicine::find($id);
        if($medicine){
            return response()->json([
                'status'=>200,
                'medicine'=>$medicine
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"Ne pas existe la ou erreur de code"
            ],404); 
        }
    }
    public function store2($id){
        $medicine=medicine::find($id);
        if($medicine){
            return response()->json([
                'status'=>200,
                'medicine'=>$medicine
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"Ne pas existe la ou erreur de code"
            ],404); 
        }
    }
    public function store3(Request $request, int $id){
        $valid=Validator::make($request->all(),[
            'nom' =>'required|String|max:191',
            'jour' =>'required|Integer',
            'taux' =>'required|Integer',
        ]);
        if($valid->fails()){
            return response()->json([
                'status' =>422,
                'errors' =>$valid->message()
            ],422);
        }
        else{
            $medicine=medicine::find($id);
          
            if($medicine ){
                $medicine->nom=$request->input('nom');
                $medicine->jour=$request->input('jour');
                $medicine->taux=$request->input('taux');
                $medicine->Update();
                
                return response()->json([
                    'status'=>200,
                    'message'=>"Medecine Update  success"
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>"No medicine found"
                ],404); 
            }
        } 
    }
    public function store4($id){
        $medicine=medicine::find($id);
        if($medicine){
            $medicine->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Donnes bien supprimer !"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"No medicine found"
            ],404); 
        }
    }
}
