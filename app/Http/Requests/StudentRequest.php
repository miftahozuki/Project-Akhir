<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'nim'      => ['required', 'string', 'unique:student_details'],
            'tahun_masuk'       => ['required', 'numeric:student_details'],
            'grade'     => ['required'],
            'address'   => ['required', 'string', 'max:255'],
            'phone'     => ['required', 'numeric',]
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'      => 'nama',
            'grade'     => 'kelas',
            'address'   => 'alamat',
            'phone'     => 'nomor hp'
        ];
    }
}
