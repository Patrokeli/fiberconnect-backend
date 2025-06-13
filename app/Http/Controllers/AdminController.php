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

    

    public function getProviderById($id)
    {
        $provider = Provider::find($id);
        if (!$provider) {
            return response()->json(['message' => 'Provider not found'], 404);
        }
        return response()->json($provider);
    }

    public function addProvider(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'speeds' => 'nullable|array',
            'prices' => 'nullable|array',
            'installation' => 'nullable|string',
            'coverage' => 'nullable|array',
        ]);

        $provider = Provider::create([
            'name' => $data['name'],
            'speeds' => $data['speeds'] ?? [],
            'prices' => $data['prices'] ?? [],
            'installation' => $data['installation'] ?? null,
            'coverage' => $data['coverage'] ?? [],
        ]);

        return response()->json($provider, 201);
    }



    public function updateProvider(Request $request, $id)
    {
        $provider = Provider::find($id);
        if (!$provider) {
            return response()->json(['message' => 'Provider not found'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|string',
            'speeds' => 'nullable|array',
            'prices' => 'nullable|array',
            'installation' => 'nullable|string',
            'coverage' => 'nullable|array',
        ]);

        // Convert arrays to JSON if necessary
        if (isset($data['speeds'])) {
            $data['speeds'] = json_encode($data['speeds']);
        }
        if (isset($data['prices'])) {
            $data['prices'] = json_encode($data['prices']);
        }
        if (isset($data['coverage'])) {
            $data['coverage'] = json_encode($data['coverage']);
        }

        $provider->update($data);
        return response()->json($provider);
    }

    public function deleteProvider($id)
    {
        $provider = Provider::find($id);
        if (!$provider) {
            return response()->json(['message' => 'Provider not found'], 404);
        }

        $provider->delete();
        return response()->json(['message' => 'Provider deleted successfully']);
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
