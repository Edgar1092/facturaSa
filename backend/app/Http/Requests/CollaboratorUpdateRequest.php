<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CollaboratorUpdateRequest extends FormRequest
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
        $id = $this->route('collaborator');
        return [
            'office_id'         =>  'required|exists:offices,id',
            'first_name'        =>  'required|string|max:50',
            'last_name'         =>  'required|string|max:50',
            'work_place'        =>  'required|string|max:200',
            'birthdate'         =>  'required|date_format:Y-m-d',
            'date_admission'    =>  'required|date_format:Y-m-d',
            'curp'              =>  "nullable|unique:collaborators,curp,{$id},id,deleted_at,NULL",
            'ine'               =>  "nullable|unique:collaborators,ine,{$id},id,deleted_at,NULL",
            'passport'          =>  "nullable|unique:collaborators,passport,{$id},id,deleted_at,NULL",
            'visa'              =>  "nullable|unique:collaborators,visa,{$id},id,deleted_at,NULL",
            'rfc'               =>  "nullable|unique:collaborators,rfc,{$id},id,deleted_at,NULL",
            'nss'               =>  "nullable|unique:collaborators,nss,{$id},id,deleted_at,NULL",
            'salary'            =>  "nullable|numeric",
            'holydays'          =>  "required|integer",
            'blood_type_id'     =>  "nullable|exists:blood_types,id"
        ];
    }
}
