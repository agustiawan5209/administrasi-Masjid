<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataDonaturRequest extends FormRequest
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
            'donatur_id' => 'nullable|exists:donaturs,id',
            'nama_donatur' => 'required|string|max:100',
            'jenis' => 'required|string|max:100',
            'jumlah' => 'required|string|max:50',
            'bukti' => 'required|image|max:1020',
            'tanggal' => 'required|date',
            'ket' => 'required|string',

        ];
    }
}
