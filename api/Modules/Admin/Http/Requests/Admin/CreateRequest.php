<?php

namespace Modules\Admin\Http\Requests\Admin;

use App\Base\Request\ApiRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends ApiRequest
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

            'name' => ['required', 'min:1', 'max:255'],
            'email' => ['required', 'min:1', 'max:255', 'exists:admins,email'],
            'phone' => ['exists:admins,phone', 'max:20'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'name.min' => __('validation.min.string'),
            'name.max' => __('validation.max.string'),
            'email.required' => __('validation.required'),
            'email.min' => __('validation.min.string'),
            'email.max' => __('validation.max.string'),
            'name.exists' => __('validation.exists'),
        ];
    }
}
