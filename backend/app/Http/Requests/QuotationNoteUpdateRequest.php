<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationNoteUpdateRequest extends FormRequest
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
            'title'             =>  "required|string|max:200",
            'description'       =>  'nullable|string',
            'quotation_id'      =>  'required|exists:quotations,id',
            'files'             =>  'nullable|array|exists:files,id'
        ];

    }
}
