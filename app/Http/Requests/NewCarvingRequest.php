<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewCarvingRequest extends FormRequest
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
            "skill"       => 'required|string|max:255',
            "division"    => 'required|string|max:255',
            "category"    => 'required|string|max:255',
            "description" => 'required|string|max:255',
            "is_for_sale" => 'required|boolean',
            "photos" => ['required', 'array', function ($attribute, $value, $fail) {
                if (count($value) > 2) {
                    return $fail('Max photo limit is 2 photos.');
                }
            }, function ($attribute, $value, $fail) {
                if (count($value) == 0) {
                    return $fail('Select at least 1 photo.');
                }
            },
            ],
            "photos.*"    => 'required|image|mimes:jpeg,png,jpg,git|max:10000'
        ];
    }
}
