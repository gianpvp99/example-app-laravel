<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index(){
        $data = Contact::all();
        return response()->json($data);
    }
    
    public function show($idContract){

        $data = DB::select('CALL ListarPorID(?)', array($idContract));
        
        if(empty($data)){
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }
        
        return response()->json($data);
    }

    // public function create(Request $request){
    //     $course = new Course();
    // }
}
