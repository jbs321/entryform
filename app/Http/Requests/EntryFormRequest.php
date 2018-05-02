<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fname'                 => 'required',
            'lname'                 => 'required',
            'email'                 => 'required|email',
            'password'              => 'required',
            'password_confirmation' => 'confirmed',
            'address'               => 'required',
            'city'                  => 'required',
            'province'              => 'required',
            'postal_code'           => 'required',
            'phone'                 => 'required|numeric',
            'number_of_carving'     => 'required|numeric',
        ];
    }
}
