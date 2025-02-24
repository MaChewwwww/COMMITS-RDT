<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class SupplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date_received' => ['required', 'date'],
            'expiration_date' => ['required', 'date', 'after:date_received'],
            'supply_name' => ['required', 'string', 'max:255'],
            'stock_number' => ['required', 'string', 'max:255'],
            'unit_of_measurement' => ['required', 'string', 'max:255'],
            'initial_quantity' => ['required', 'integer', 'min:1'],
            'consumed_quantity' => ['required_if:_method,PUT', 'integer', 'min:0'], // Add this line
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'date_received.required' => 'The date when the supply was received must be provided.',
            'date_received.date' => 'Please enter a valid date format for date received.',
            
            'expiration_date.required' => 'The expiration date of the supply must be provided.',
            'expiration_date.date' => 'Please enter a valid date format for expiration date.',
            'expiration_date.after' => 'The expiration date must be later than the date received.',
            
            'supply_name.required' => 'Please specify the name of the supply.',
            'supply_name.string' => 'The supply name must be text.',
            'supply_name.max' => 'The supply name cannot exceed 255 characters.',
            
            'stock_number.required' => 'A stock number must be assigned to this supply.',
            'stock_number.string' => 'The stock number must be text.',
            'stock_number.max' => 'The stock number cannot exceed 255 characters.',
            
            'unit_of_measurement.required' => 'Please specify the unit of measurement (e.g., pieces, boxes, etc.).',
            'unit_of_measurement.string' => 'The unit of measurement must be text.',
            'unit_of_measurement.max' => 'The unit of measurement cannot exceed 255 characters.',
            
            'initial_quantity.required' => 'Please enter the initial quantity of the supply.',
            'initial_quantity.integer' => 'The initial quantity must be a whole number.',
            'initial_quantity.min' => 'The initial quantity must be at least 1 unit.',
            
            'consumed_quantity.required_if' => 'Please specify how many units have been consumed when updating.',
            'consumed_quantity.integer' => 'The consumed quantity must be a whole number.',
            'consumed_quantity.min' => 'The consumed quantity cannot be less than 0.',
            
            'user_id.required' => 'Please select a Member of Room (MOR) for this supply.',
            'user_id.exists' => 'The selected Member of Room (MOR) is not valid in our records.',
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