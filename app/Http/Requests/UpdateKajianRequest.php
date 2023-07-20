<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKajianRequest extends FormRequest
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
            'slug'=> 'required|exists:kajians,id',
            'judul'=> 'required|string|max:100',
            'uztadz'=> 'required|string|max:100',
            'tanggal'=> 'required|date',
            'ket'=> 'required|string',
            'penanggung_jawab'=> 'required|string|max:100',

        ];
    }
}
