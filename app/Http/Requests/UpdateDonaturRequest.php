<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonaturRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'slug'=> 'required|exists:donaturs,id',
            'nama'=> 'required|string|max:50',
            'alamat'=> 'required|string|max:255',
            'no_telpon'=> 'required|string|max:50',
        ];
    }
}
