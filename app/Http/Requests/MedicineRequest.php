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
            'medicine_name' => ['required', 'string', 'max:100'],
            'stock_number' => ['required', 'string', 'max:100'],
            'unit_of_measurement' => ['required', 'string', 'max:100'],
            'initial_quantity' => ['required', 'numeric', 'min:0'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'expiration_date.after' => 'The expiration date must be after the date received.',
            'initial_quantity.min' => 'The initial quantity must be at least 0.',
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