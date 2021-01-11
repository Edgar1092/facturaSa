<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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

        $id = $this->route('user');

        return [
            'avatar'        =>  'nullable|string',
            'email'         =>  "required|email|unique:users,email,{$id},id,deleted_at,NULL",
            'password'      =>  'required|string|min:6',
            'first_name'    =>  'required|string|max:50',
            'last_name'     =>  'required|string|max:50',

        ];
    }
}
