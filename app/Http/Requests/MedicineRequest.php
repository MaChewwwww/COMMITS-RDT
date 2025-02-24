<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class MedicineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow all authenticated users
    }

    public function rules(): array
    {
        return [
            'date_received' => ['required', 'date'],
            'expiration_date' => [
                'required', 
                'date', 
                'after:date_received'
            ],
            'medicine_name' => 'required|string|max:100', // Removed any format validation
            'stock_number' => ['required', 'string', 'max:100'],
            'unit_of_measurement' => ['required', 'string', 'max:10'],
            'initial_quantity' => ['required', 'numeric', 'min:1'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            // Date Received
            'date_received.required' => 'Please enter the date received.',
            'date_received.date' => 'The date received must be a valid date.',

            // Expiration Date
            'expiration_date.required' => 'Please enter the expiration date.',
            'expiration_date.date' => 'The expiration date must be a valid date.',
            'expiration_date.after' => 'The expiration date must be after the date received.',

            // Medicine Name
            'medicine_name.required' => 'Please enter the medicine name.',
            'medicine_name.string' => 'The medicine name must be text.',
            'medicine_name.max' => 'The medicine name cannot exceed 100 characters.',

            // Stock Number
            'stock_number.required' => 'Please enter the stock number.',
            'stock_number.string' => 'The stock number must be text.',
            'stock_number.max' => 'The stock number cannot exceed 100 characters.',

            // Unit of Measurement
            'unit_of_measurement.required' => 'Please enter the unit of measurement.',
            'unit_of_measurement.string' => 'The unit of measurement must be text.',
            'unit_of_measurement.max' => 'The unit of measurement cannot exceed 100 characters.',

            // Initial Quantity
            'initial_quantity.required' => 'Please enter the initial quantity.',
            'initial_quantity.numeric' => 'The initial quantity must be a number.',
            'initial_quantity.min' => 'The initial quantity must be greater than 0.',

            // User ID
            'user_id.required' => 'Please select a user.',
            'user_id.exists' => 'The selected user is invalid.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Convert dates to proper format if needed
        if ($this->filled('date_received')) {
            $this->merge([
                'date_received' => Carbon::parse($this->date_received)->format('Y-m-d H:i:s')
            ]);
        }

        if ($this->filled('expiration_date')) {
            $this->merge([
                'expiration_date' => Carbon::parse($this->expiration_date)->format('Y-m-d H:i:s')
            ]);
        }
    }
}