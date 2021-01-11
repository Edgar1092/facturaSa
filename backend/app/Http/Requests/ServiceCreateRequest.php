<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceCreateRequest extends FormRequest
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
        $id = $this->route('service');
        return [
            'name'          =>  "required|string|max:100|unique:services,name,{$id},id,deleted_at,NULL",
            'description'   =>  'nullable|string',
            'office_id'     =>  'required|exists:offices,id',
            'utility'       =>  'required|boolean',
            'operator_commission'   =>  'required|boolean'
        ];

    }
}
