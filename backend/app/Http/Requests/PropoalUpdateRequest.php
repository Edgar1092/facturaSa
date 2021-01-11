<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PropoalUpdateRequest extends FormRequest
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
            'office_id'         =>  'required|exists:offices,id',
            'client_id'         =>  'required|exists:clients,id',
            'expiration_date'   =>  'nullable|date_format:Y-m-d',
            'observation'       =>  'nullable|string',
            'files'             =>  'nullable|array|exists:files,id',
        ];
    }
}
