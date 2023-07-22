<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTabelShalatRequest extends FormRequest
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
            'jenis' => 'required|string',
            'tanggal' => 'required|date',
            'hari' => 'required|string|max:50',
            'waktu' => 'nullable|string|max:50',
            'waktu_array' => 'nullable|array',
            'jam' => 'nullable',
            'muadzin' => 'nullable|string:max:50',
            'khotbah' => 'nullable|string|max:50',
            'imam' => 'nullable|string|max:50',
        ];
    }
}
