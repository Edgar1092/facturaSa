<?php

namespace App\Http\Requests;

use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
use Illuminate\Foundation\Http\FormRequest;

class CreditCardUpdateRequest extends FormRequest
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
        $id = $this->route('credit_card');
        $client_id = request()->client_id;
        return [
            'client_id'         => 'required|exists:clients,id',
            'card_number'       => ['required',new CardNumber,"unique:credit_cards,card_number,{$id},id,deleted_at,NULL,client_id,{$client_id}"],
            'expiration_year'   => ['nullable', new CardExpirationYear($this->get('expiration_month'))],
            'expiration_month'  => ['nullable', new CardExpirationMonth($this->get('expiration_year'))],
            'cvc'               => ['nullable', new CardCvc($this->get('card_number'))]
        ];
    }
}
