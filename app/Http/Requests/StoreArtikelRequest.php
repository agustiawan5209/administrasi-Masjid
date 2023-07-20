<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtikelRequest extends FormRequest
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
            'foto'=> 'required|image|max:1020',
            'judul'=> 'required|string|max:100',
            'kategori'=> 'required|string|max:100',
            'tanggal'=> 'required|date',
            'isi'=> 'required',
        ];
    }
}
