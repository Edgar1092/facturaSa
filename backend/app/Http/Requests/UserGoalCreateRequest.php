<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGoalCreateRequest extends FormRequest
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
            'user_id'           =>  'required|exists:users,id',
            'start_date'        =>  'required|date_format:Y-m-d',
            'end_date'          =>  'required|date_format:Y-m-d',
            'amount'            =>  'required|numeric',
            'description'       =>  'nullable|string',
            'office_id'         =>  'required|exists:offices,id'
        ];

    }
}
