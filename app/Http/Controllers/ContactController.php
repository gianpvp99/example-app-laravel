<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $data = Contact::all();
        return response()->json($data);
    }

    // public function show($idContract){

    //     $data = DB::select('CALL ListarPorID(?)', array($idContract));

    //     if(empty($data)){
    //         return response()->json(['message' => 'No se encontraron resultados'], 404);
    //     }

    //     return response()->json($data);
    // }

    public function register(Request $payload)
    { // Almacenar los parametros en el $payload
        $fullName = $payload->input('fullname');
        $email = $payload->input('email');
        $phone = $payload->input('phone');
        $message = $payload->input('message');
        $ipUser = $payload->ip();


        // Verificar si la solicitud ha superado el límite de solicitudes
        // if ($payload->limiter()->attempts($this->throttleKey($payload)) > 3) {
        //     // Si ha superado el límite, responde con un mensaje indicando el límite alcanzado
        //     return response()->json(['message' => 'Límite de solicitudes alcanzado'], 200);
        // }

        //EJECUTAR PROCEDIMIENTO ALMACENADO

        try {

            // Ejecutar el procedimiento almacenado
            $RegisterContact = DB::select('CALL RegisterContact(?,?,?,?,?,@resultado)', [$fullName, $email, $phone, $message, $ipUser], 200);
            $state = DB::select('SELECT @resultado as state')[0]->state;
            
            $RegisterContact[0]->state = $state;

            return response()->json($RegisterContact[0]);
        } catch (\Exception $e) {
            // En caso de excepción, proporciona un mensaje de error personalizado
            return response()->json(['message' => 'Error al registrar datos: ' . $e->getMessage()],500);
        }
    }

}
