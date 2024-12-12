<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicineController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inventory', function () {
    $medicines = [
        [
            "dateReceived" => "4/30/24",
            "stockNumber" => "03-005",
            "name" => "Celecoxib 200mg",
            "unit" => "Capsule",
            "quantity" => "174",
            "consumed" => "34",
            "balance" => "140",
            "expiryDate" => "March '25",
            "supplier" => "Main Campus",
            "memorandumReceipt" => "Melissa P. Sarapuddin, MD",
        ],
        [
            "dateReceived" => "4/30/24",
            "stockNumber" => "12-002",
            "name" => "Mefenamic Acid 500mg",
            "unit" => "Capsule",
            "quantity" => "678",
            "consumed" => "28",
            "balance" => "650",
            "expiryDate" => "Aug '25",
            "supplier" => "Main Campus",
            "memorandumReceipt" => "Melissa P. Sarapuddin, MD",
        ],
        [
            "dateReceived" => "8/12/24",
            "stockNumber" => "16-003",
            "name" => "Paracetamol 500mg",
            "unit" => "Tablet",
            "quantity" => "486",
            "consumed" => "48",
            "balance" => "448",
            "expiryDate" => "Oct '25",
            "supplier" => "Main Campus",
            "memorandumReceipt" => "Melissa P. Sarapuddin, MD",
        ],
    ];
    return view('inventory.inventory', ["medicines" => $medicines]);
});
