<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKasMasjidRequest extends FormRequest
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
            'kode'=> 'required|exists:kas_masjids,kode',
            'tanggal'=> 'required|date',
            'kas_masuk'=> 'required|numeric',
            'kas_keluar'=> 'required|numeric',
            'ket_kas_masuk'=> 'required|string|max:100',
            'ket_kas_keluar'=> 'required|string|max:100',
            'total_kas'=> 'required|numeric',
        ];
    }
}
