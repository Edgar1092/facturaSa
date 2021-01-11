<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Quotation;
class PaymentUpdateRequest extends FormRequest
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
        $id = $this->route('payment');
        $rules = [
            'client_id'         =>  'required|exists:clients,id',
            'quotation_id'      =>  [
                'required',
                function($attribute, $val, $fail)
                {
                    $n = Quotation::whereHas('status',function($q){
                        $q->whereIn('name',['Aprobada']);
                    })->count();
                    if(!$n)
                    {
                        $fail('La cotización no ha sido aprobada aun');
                    }
                }
            ],
            'currency_id'       =>  [
                'required',
                'exists:currencies,id',
                function($attribute, $val, $fail)
                {
                    $quotation = Quotation::find(request()->quotation_id);

                    if($quotation && $quotation->currency_id != request()->currency_id)
                    {
                        $fail('El tipo de moneda debe ser igual al cotizado!');
                    }

                }

            ],

            'payment_method_id' =>  'required|exists:payment_methods,id',
            'conceot'           =>  'nullable|string',
            'import'            =>  [
                'required',
                'numeric',
                function($attribute, $val, $fail)
                {
                    $quotation = Quotation::find(request()->quotation_id);
                    $balance = 0;
                    if($quotation)
                    {
                        $balance = $quotation->total - $quotation->payments()->where('id','!=',$id)->sum('import');
                    }

                    if(!$quotation || $balance == 0 || (floatval(request()->import)>$balance))
                    {
                        $fail('El monto supera el valor de la deuda' );
                    }

                }
            ],
            'date_payment'      =>  'required|date_format:Y-m-d',
            'folio_number'      =>  'nullable|string|max:200',
            'concept'           =>  'required',
            'files'             =>  'nullable|array|exists:files,id'


        ];
        return $rules;


    }
}
