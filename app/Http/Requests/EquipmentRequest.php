<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'general_description' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
            'quantity_of_request' => ['required', 'integer', 'min:0'],
            'serviceable' => ['sometimes', 'boolean'],
            'for_repair' => ['sometimes', 'boolean'],
            'for_condemn' => ['sometimes', 'boolean'],
            'need_replacement' => ['sometimes', 'boolean'],
            'additional' => ['sometimes', 'boolean'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'general_description.required' => 'Please provide a general description of the equipment.',
            'general_description.string' => 'The general description must be text.',
            'general_description.max' => 'The general description must not exceed 255 characters.',
            
            'quantity.required' => 'Please specify the total quantity of this equipment.',
            'quantity.integer' => 'The quantity must be a whole number.',
            'quantity.min' => 'The quantity cannot be less than 0.',
            
            'quantity_of_request.required' => 'Please specify how many units are being requested.',
            'quantity_of_request.integer' => 'The quantity of request must be a whole number.',
            'quantity_of_request.min' => 'The quantity of request cannot be less than 0.',
            
            'serviceable.boolean' => 'The serviceable status must be either yes or no.',
            'for_repair.boolean' => 'The for repair status must be either yes or no.',
            'for_condemn.boolean' => 'The for condemn status must be either yes or no.',
            'need_replacement.boolean' => 'The need replacement status must be either yes or no.',
            'additional.boolean' => 'The additional status must be either yes or no.',
            
            'user_id.required' => 'Please select a Member of Room (MOR) for this equipment.',
            'user_id.exists' => 'The selected Member of Room (MOR) is not valid in our records.',
        ];
    }
}