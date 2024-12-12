<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boxes;
use App\Models\Medicine;
use App\Models\User;
use Carbon\Carbon;

class MedicineController extends Controller
{
    public function index()
    {
        // Get all medicines with box relationship
        $users = User::all();
        $medicines = Medicine::with('box')->get();

        // Calculate quantities
        $totalMedicine = $medicines->sum('remaining_quantity');
        $expiredMedicine = Medicine::where('expiration_date', '<', Carbon::now()->addDay())
            ->sum('remaining_quantity');
        $nearExpiredMedicine = Medicine::whereBetween('expiration_date', [
            Carbon::now(),
            Carbon::now()->addMonth()
        ])->sum('remaining_quantity');

        // Count returned and not returned medicines
        $returnedMedicines = $medicines->filter(function($medicine) {
            return $medicine->box->isReturned == true;
        })->count();

        $notReturnedMedicines = $medicines->filter(function($medicine) {
            return $medicine->box->isReturned == false;
        })->count();

        return view('medicine.medicine_index', 
            compact('medicines', 'totalMedicine', 'expiredMedicine', 'nearExpiredMedicine',
                    'returnedMedicines', 'notReturnedMedicines', 'users'));
    }

    public function add(){
        $users = User::all();
        return view('medicine.add_medicine', compact('users'));
    }

    public function store(Request $request)
    {
            // Validate medicine data
            $data = $request->validate([
                'stock_number' => 'required',
                'unit_of_measurement' => 'required|alpha',
                'medicine_name' => 'required',
                'initial_quantity' => 'required|numeric',
                'supplier_name' => 'required',
                'date_received' => 'required|date',
                'user_id' => 'required',
                'expiration_date' => 'required|date',
            ]);

            // Create box 
            $box = Boxes::create([
                'date_received' => $data['date_received'],
                'stock_number' => $data['stock_number'],
                'isReturned' => False,
                'supplier_name' => $data['supplier_name'] ?? 'PUP Sta. Mesa',
                'user_id' => 1, // Assign user ID 1 for testing
            ]);

            // Create medicine             
            // Try using relationship instead of direct creation
            $medicine = $box->medicine()->create([
                'medicine_name' => $data['medicine_name'],
                'initial_quantity' => $data['initial_quantity'],
                'remaining_quantity' => $data['initial_quantity'], 
                'unit' => $data['unit_of_measurement'],
                'status' => 'Full', 
                'expiration_date' => $data['expiration_date']
            ]);

            return redirect()->route('medicine_dashboard')
                ->with('success', 'Medicine added successfully');

    }

    public function update(Request $request, Medicine $medicine)
    {
        // Validate medicine data
        $data = $request->validate([
            'medicine_name' => 'required',
            'stock_number' => 'required',
            'initial_quantity' => 'required|numeric|min:'.$medicine['consumed_quantity'].'|max:999999',
            'unit_of_measurement' => 'required|alpha',
            'supplier_name' => 'required',
            'date_received' => 'required|date',
            'user_id' => 'required',
            'expiration_date' => 'required|date',
        ]);

        // Update medicine
        $remainingQty = $data['initial_quantity'] - $medicine['consumed_quantity'];
        if ($remainingQty < 1) {
            $remainingQty = 0;
        }

        $medicine->update([
            'medicine_name' => $data['medicine_name'],
            'initial_quantity' => $data['initial_quantity'],
            'consumed_quantity' => $medicine['consumed_quantity'],
            'remaining_quantity' => $remainingQty,
            'unit' => $data['unit_of_measurement'],
            'expiration_date' => $data['expiration_date'],
            'status' => $remainingQty == $data['initial_quantity'] ? 'Full' :
                   ($remainingQty == 0 ? 'Out of Stock' :
                   ($remainingQty <= ($data['initial_quantity'] * 0.2) ? 'Low Stock' : 'In Stock'))
        ]);

        // Update associated box
        $medicine->box->update([
            'stock_number' => $data['stock_number'],
            'date_received' => $data['date_received'],
            'supplier_name' => $data['supplier_name'],
            'user_id' => $data['user_id']
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
            'remaining_quantity' => $medicine->remaining_quantity - $data['quantity'],
            'status' => $medicine->remaining_quantity - $data['quantity'] == $medicine->initial_quantity ? 'Full' :
                   ($medicine->remaining_quantity - $data['quantity'] == 0 ? 'Out of Stock' :
                   ($medicine->remaining_quantity - $data['quantity'] <= ($medicine->initial_quantity * 0.2) ? 'Low Stock' : 'In Stock'))
        ]);

        return redirect()->route('medicine_dashboard')
            ->with('success', 'Medicine quantity has been deducted');
    }
}
