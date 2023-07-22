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
            'slug'=> 'required|exists:tabel_shalats,id',
            'jenis' => 'required|string',
            'tanggal' => 'required|date',
            'hari' => 'required|string|max:50',
            'waktu' => 'required|string|max:50',
            'jam' => 'required',

            'muadzin' => 'nullable|string:max:50',
            'khotbah' => 'nullable|string|max:50',
            'imam' => 'nullable|string|max:50',
        ];
    }
}
