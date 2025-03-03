<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::all());
    }

    public function store(Request $request) {
    
        $client = Client::create([
            'firstname' => $request->firstname ,
            'lastname' => $request->lastname ,
            'email' => $request->email ,
            'phone' => $request->phone,
            'status' => $request->status
        ]);
        
        return response()->json([
            'message' => 'Client Successfully Created',
            'success' => true,
            'idClient' => $client->id
        ], 200);

    }

    public function delete($clientId) {
        $client = Client::find($clientId);
        if ($client) {
            $client->delete();
            return response()->json(['message' => 'Client deleted', 200]);
        }

        return response()->json(['message' => 'Client not found'], 404);
    }

    public function show($clientId){

        $client = Client::find($clientId);
        if ($client) {
            return response()->json($client);
        }
        return response()->json(['message' => 'Client not found'], 404);
    }

    public function update(Request $request, $clientId) {
        $client = Client::find($clientId);
        if ($client) {
            $client->update($request->all());
            return response()->json($client);
        }
        return response()->json(['message' => 'Client not found'], 404);

    }

}
