<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate(['location' => 'required|string']);
        
        $location = Location::with('providers')
            ->where('name', 'like', '%'.$request->location.'%')
            ->first();
            
        return response()->json($location);
    }
}