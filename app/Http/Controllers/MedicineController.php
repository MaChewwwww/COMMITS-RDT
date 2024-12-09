<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boxes;
use App\Models\Medicine;

class MedicineController extends Controller
{
    public function index(){
        $medicines = Medicine::with('box')->get();
        return view('medicine.medicine_index', compact('medicines'));
    }

    public function add(){
        return view('medicine.add_medicine');
    }

    public function store(Request $request)
    {
            // Validate medicine data
            $data = $request->validate([
                'medicine_name' => 'required',
                'description' => 'required',
                'initial_quantity' => 'required|numeric',
                'unit_of_measurement' => 'required',
                'expiration_date' => 'required|date',
            ]);

            // Create box 
            $box = Boxes::create([
                'date_received' => now(),
                'box_name' => 'Box for ' . $data['medicine_name'],
                'description' => $data['description'],
                'status' => 'Full',
                'supplier_name' => $data['supplier_name'] ?? 'PUP Sta. Mesa',
                'user_id' => auth()->id(), // Assign the logged-in user ID
            ]);
            \Log::info('Box created with ID: ' . $box->id);

            // Create medicine 
            \Log::info('Creating medicine with data:', [
                'medicine_data' => $data,
                'box_id' => $box->id
            ]);
            
            // Try using relationship instead of direct creation
            $medicine = $box->medicine()->create([
                'medicine_name' => $data['medicine_name'],
                'description' => $data['description'],
                'initial_quantity' => $data['initial_quantity'],
                'remaining_quantity' => $data['initial_quantity'], 
                'unit_of_measurement' => $data['unit_of_measurement'],
                'expiration_date' => $data['expiration_date']
            ]);

            return redirect()->route('medicine_dashboard')
                ->with('success', 'Medicine added successfully');

    }

    public function edit(Medicine $medicine){
        return view('medicine.edit_medicine', ['medicine' => $medicine]);
    }

    public function update(Request $request, Medicine $medicine)
    {
        // Validate medicine data
        $data = $request->validate([
            'medicine_name' => 'required',
            'description' => 'required',
            'initial_quantity' => 'required|numeric',
            'unit_of_measurement' => 'required',
            'expiration_date' => 'required|date',
        ]);

        // Update medicine
        $medicine->update([
            'medicine_name' => $data['medicine_name'],
            'description' => $data['description'],
            'initial_quantity' => $data['initial_quantity'],
            'remaining_quantity' => $data['initial_quantity'],
            'unit_of_measurement' => $data['unit_of_measurement'],
            'expiration_date' => $data['expiration_date']
        ]);

        // Update associated box
        $medicine->box->update([
            'box_name' => 'Box for ' . $data['medicine_name'],
            'description' => $data['description'],
        ]);

        return redirect()->route('medicine_dashboard')
            ->with('success', 'Medicine updated successfully');
    }
    
    public function deduct(Request $request, Medicine $medicine)
    {
        $data = $request->validate([
            'quantity' => 'required|numeric|min:0.01|max:'.$medicine->remaining_quantity,
        ]);

        $medicine->update([
            'consumed_quantity' => $medicine->consumed_quantity + $data['quantity'],
            'remaining_quantity' => $medicine->remaining_quantity - $data['quantity']
        ]);

        // Calculate and update box status after deduction
        $this->calculateBoxStatus($medicine);

        return redirect()->route('medicine_dashboard')
            ->with('success', 'Medicine quantity has been deducted');
    }

    public function calculateBoxStatus(Medicine $medicine)
    {
        $percentageRemaining = ($medicine->remaining_quantity / $medicine->initial_quantity) * 100;
        
        if ($medicine->remaining_quantity == 0) {
            $medicine->box->update(['status' => 'Empty']);
        } elseif ($percentageRemaining <= 20) {
            $medicine->box->update(['status' => 'Low Stock']);
        }
    }
}
