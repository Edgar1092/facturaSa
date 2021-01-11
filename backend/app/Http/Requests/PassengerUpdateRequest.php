<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassengerUpdateRequest extends FormRequest
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
        $id = $this->route('passenger');
        return [
            'first_name'                        =>  'required|string|max:100',
            'last_name'                         =>  'required|string|max:100',
            'premier_number'                    =>  'nullable|string|max:20',
            'birthdate'                         =>  'nullable|date_format:Y-m-d',
            'email'                             =>  'nullable|string|max:100|email',
            'mobile'                            =>  'nullable|string|max:20',
            'phone'                             =>  'nullable|string|max:20',
            'observation'                       =>  'nullable|string',
            'country_id'                        =>  'nullable|exists:countries,id',
            'city'                              =>  'nullable|string|max:50',
            'street'                            =>  'nullable|string|max:200',
            'colony'                            =>  'nullable|string|max:200',
            'zip_code'                          =>  'nullable|string|max:10',
            'nationalities.*.country_id'        =>  'required|exists:countries,id',
            'nationalities.*.passport'          =>  "nullable|string|max:20|unique:passenger_nationalities,passport,{$id},passenger_id,deleted_at,NULL",
            'nationalities.*.passport_expired_date' =>  'nullable|required_with:passport|date_format:Y-m-d',
            'nationalities.*.visa'              =>  "nullable|string|max:20|unique:passenger_nationalities,visa,{$id},passenger_id,deleted_at,NULL",
            'nationalities.*.visa_expired_date' =>  'nullable|required_with:visa|date_format:Y-m-d',
            'nationalities.*.ine'               =>  "nullable|string|max:20|unique:passenger_nationalities,ine,{$id},passenger_id,deleted_at,NULL",
            'nationalities.*.curp'              =>  "nullable|string|max:20|unique:passenger_nationalities,curp,{$id},passenger_id,deleted_at,NULL",
            'emergency_contacts'                =>  'nullable|array',
            'emergency_contacts.*.first_name'   =>  'required_with:emergency_contacts|string|max:100',
            'emergency_contacts.*.last_name'    =>  'required_with:emergency_contacts|string|max:100',
            'emergency_contacts.*.phone'        =>  'nullable|string|max:20',
            'emergency_contacts.*.mobil'        =>  'nullable|string|max:20',
            'emergency_contacts.*.email'        =>  'nullable|string|max:100',
            'files'                             =>  'nullable|array'
        ];
    }
}
