<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaveSessionController extends Controller
{
    public function saveIDToSession(Request $request)
    {
        $lists_ID = session("lists_ID");
        $serviceId = $request->input('service_id');
        $lists_ID[]= $serviceId;

        session(['lists_ID' => $lists_ID]);

        return response()->json(['message' => 'saved to session successfully']);
    }
}
