<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required:min:3',
            'nisn' => 'required|digits:10|unique:students,nisn',
            'nis_sekolah' => 'required',
            'nis_pesantren' => 'required|unique:students,nis_pesantren',
            'jenis_kelamin' => 'required',
            'nik' => 'required|digits:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'tahun_masuk' => 'required',
            'status_sosial' => 'required',
            'status_rumah' => 'required',
            'is_asrama' => 'required',
            // 'nomor_yatim' => 'required',
            'no_kk' => 'required|digits:16',
            'hubungan_keluarga' => 'required',
            'anak_ke' => 'required',
            'dari_jumlah_saudara' => 'required',
            'jumlah_saudara_laki_laki' => 'required',
            'jumlah_saudara_perempuan' => 'required',
            'nomor_registrasi_akte_lahir' => 'required',
            // 'hobi' => 'required',
            // 'cita_cita' => 'required',
            // 'tinggi_badan' => 'required',
            // 'berat_badan' => 'required',
            'golongan_darah' => 'required',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
