<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDignitaireRequest extends FormRequest
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
          'nom' => 'required|string|max:30',
          // 'postnom'=> 'required|string|max:30',
          'prenom'=> 'required|string|max:30',
          'lieu_naissance'=> 'required|string|max:50',
          'date_naissance'=> 'required|date',
          'nationalite'=> 'required|string|max:50',
          'fonction'=> 'required|string|max:50',
          'idmedailles'=> 'required|exists:medailles',
          'date_decoration'=> 'required|date',
          'num_brevet'=> 'required|string|max:50',
        ];
    }
}
