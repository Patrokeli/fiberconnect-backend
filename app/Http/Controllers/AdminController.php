<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
    //create customer
     public function createCustomer(Request $request)
    {
       $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            // Phone number must start with +255 followed by 9 digits (Tanzanian phone format)
            'phone' => ['nullable', 'string', 'regex:/^\+255\d{9}$/'],
            // Region must be one of the allowed values
            'region' => ['nullable', 'string', 'in:Arusha,Dar es Salaam,Dodoma,Mwanza,Mbeya,Morogoro,Tanga,Kilimanjaro,Zanzibar,Other'],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'phone' => $request->phone,
            'region' => $request->region,
        ]);

        return response()->json($user, 201);
    }

    // Edit customer info (update)
    public function updateCustomer(Request $request, $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            // Add more fields if needed
        ]);

        $user->update($request->only(['name', 'email'])); // update fields as needed

        return response()->json($user);
    }

    // Delete customer
    public function deleteCustomer($id)
    {
        $user = User::where('role', 'user')->findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
