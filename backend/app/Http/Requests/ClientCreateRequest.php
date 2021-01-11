<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;

class ClientCreateRequest extends FormRequest
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
        $id = $this->route('client');

        return [
            'parent_id'         =>  [
                'nullable',
                Rule::exists('clients', 'id')
                ->where(function ($query){
                    $query->where('type', 'company');
                    $query->whereNull('parent_id');
                }),
            ],
            'name'                              =>  'required|string|max:200',
            'rfc'                               =>  "nullable|string|max:20|unique:clients,rfc,{$id},id,deleted_at,NULL",
            'contact_person'                    =>  'nullable|string|max:50',
            'email'                             =>  'nullable|string|max:100|email',
            'mobile'                            =>  'nullable|string|max:20',
            'phone'                             =>  'nullable|string|max:20',
            'observation'                       =>  'nullable|string',
            'country_id'                        =>  'required|exists:countries,id',
            'city'                              =>  'required|string|max:50',
            'street'                            =>  'nullable|string|max:200',
            'colony'                            =>  'nullable|string|max:200',
            'zip_code'                          =>  'nullable|string|max:10',
            'payment_method_id'                 =>  'required|exists:payment_methods,id',
            'credit_cards'                      =>  'nullable|array',
            'credit_cards.*.id'                 =>  'nullable|integer',
            'credit_cards.*.card_number'        =>  ['nullable',new CardNumber],
            'credit_cards.*.expiration_year'    =>  ['nullable','integer','min:'.date('Y')],
            'credit_cards.*.expiration_month'   =>  ['nullable','integer'],
            'office_id'                         =>  'required|exists:offices,id'
        ];
    }
}
