<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuotationCreateRequest extends FormRequest
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
            'client_id'                     =>  'required|exists:clients,id',
            'propoal_id'                    =>  'required|exists:propoals,id',
            'observation'                   =>  'nullable|string',
            'destinations'                  =>  'required|array|min:1',
            'destinations.*.id'             =>  'nullable|integer',
            'destinations.*.name'           =>  'required|string|max:200',
            'destinations.*.description'    =>  'nullable|string',
            'destinations.*.start_date'     =>  'required|date_format:Y-m-d|before_or_equal:destinations.*.end_date|after_or_equal:start_date|before_or_equal:end_date',
            'destinations.*.end_date'       =>  'required|date_format:Y-m-d|after_or_equal:start_date|before_or_equal:end_date',
            'quantity_childrens'            =>  'required|integer|min:0',
            'quantity_adults'               =>  'required|integer|min:0',
            'quantity_elderly'              =>  'required|integer|min:0',
            'start_date'                    =>  'nullable|date_format:Y-m-d|before_or_equal:end_date',
            'end_date'                      =>  'nullable|date_format:Y-m-d',
            'files'                         =>  'nullable|array|exists:files,id',
            'details'                       =>  'required|array|min:1',
            'details.*.service_id'          =>  'required|exists:services,id',
            'details.*.description'         =>  'nullable|string' ,
            'details.*.price'               =>  'required|numeric',
            'details.*.quantity'            =>  'required|integer|min:1',
            'details.*.confirm'             =>  'required|boolean',
            'office_id'                     =>  'required',
            'exchange_rate'                 =>  'required|numeric|min:1'
        ];
    }
}
