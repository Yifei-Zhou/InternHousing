<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function index()
    {
        return Listing::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'price' => 'required'
        ]);

        $listing = new Listing($request->all());
        $listing->user_id = Auth::id();
        $listing->save();

        return response()->json($listing, 201);
    }

    public function show($id)
    {
        return Listing::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update($request->all());
        return response()->json($listing, 200);
    }

    public function destroy($id)
    {
        Listing::destroy($id);
        return response()->json(null, 204);
    }
}
