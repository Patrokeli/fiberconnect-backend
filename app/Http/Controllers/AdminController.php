<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

   

    public function getProviders()
    {
        return response()->json(Provider::all());
    }

    public function addProvider(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $provider = Provider::create($request->only('name'));
        return response()->json($provider);
    }

    public function getCustomers()
    {
        return response()->json(User::where('role', 'user')->get());
    }
}
