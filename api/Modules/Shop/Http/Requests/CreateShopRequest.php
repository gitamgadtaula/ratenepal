<?php

namespace Modules\Shop\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateShopRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'motto' => 'string',
            'website' => 'required',
            'desc' => 'required',
            'location' => 'required',
            'contact' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
