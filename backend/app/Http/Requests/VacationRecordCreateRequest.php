<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VacationRecordCreateRequest extends FormRequest
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
            'collaborator_id'   =>  'required|exists:collaborators,id',
            'date_start'        =>  'required|date_format:Y-m-d',
            'date_end'          =>  'required|date_format:Y-m-d',
            'days'              =>  'required|integer|min:1',
            'observation'       =>  'nullable|string'
        ];
    }
}
