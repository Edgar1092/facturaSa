<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficeCreateRequest extends FormRequest
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
            'name'              =>  'required|string|max:100',
            'contact'           =>  'nullable|string|max:70',
            'email'             =>  'nullable|email|max:100',
            'phone_1'           =>  'nullable|string|max:20',
            'phone_2'           =>  'nullable|string|max:20',
            'zip_code'          =>  'nullable|string|max:20',
            'city'              =>  'nullable|string|max:50',
            'street'            =>  'nullable|string|max:50',
            'colony'            =>  'nullable|string|max:50',
            'observation'       =>  'nullable|string',
            'responsible_id'    =>  'nullable|exists:users,id'

        ];
    }
}
