<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return view('buses', compact('buses'));
    }
    // Store a new bus
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        // Create a new bus
        Bus::create($validatedData);

        // Redirect to a success page or dashboard
        return redirect()->route('buses')->with('success', 'Bus added successfully!');
    }
    // Update an existing bus
    public function update(Request $request, Bus $bus)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        // Update the bus with validated data
        $bus->update($validatedData);

        // Redirect to a success page or dashboard
        return redirect()->route('buses')->with('success', 'Bus updated successfully!');
    }
    public function destroy(Bus $busId)
    {
 

        if (!$busId) {
            return redirect()->route('buses')->with('error', 'Bus not found');
        }

        // Delete the bus
        $busId->delete();

        return redirect()->route('buses')->with('success', 'Bus deleted successfully');
    }
}
