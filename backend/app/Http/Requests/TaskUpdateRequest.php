<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskUpdateRequest extends FormRequest
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
            'status_id'         =>  [
                'required',
                Rule::exists('statuses', 'id')
                ->where(function ($query){
                    $query->where('type', 'tasks');
                }),
            ],
            'office_id'         =>  'required|exists:offices,id',
            'task_type_id'      =>  'required|exists:task_types,id',
            'client_id'         =>  'nullable|exists:clients,id|required_with:quotation_id',
            'quotation_id'      =>  'nullable|exists:quotations,id',
            'name'              =>  'required|string|max:200',
            'description'       =>  'nullable|string',
            'expiration_date'   =>  'nullable|date_format:Y-m-d',
            'files'             =>  'nullable|array',
            'files.*'           =>  'nullable|exists:files,id'

        ];
    }
}
