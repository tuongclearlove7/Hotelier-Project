<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RemoveSessionController extends Controller
{
    public function removeIDFromSession(Request $request)
    {
        $lists_ID = session("lists_ID");
        $serviceId = $request->input('service_id');
    
        $index = array_search($serviceId, $lists_ID);
        if ($index !== false) {
            unset($lists_ID[$index]);
        }
        
        session(['lists_ID' => $lists_ID]);


        return response()->json(['message' => 'remove to session successfully']);
    }
}
