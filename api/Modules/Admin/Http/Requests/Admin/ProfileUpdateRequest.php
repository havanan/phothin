<?php

namespace Modules\Admin\Http\Requests\Admin;

use App\Base\Request\ApiRequest;

class ProfileUpdateRequest extends ApiRequest
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
            'id' => ['required', 'numeric', 'exists:admins,id'],
            'name' => ['required', 'min:1', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => __('validation.required'),
            'id.numeric' => __('validation.numeric'),
            'id.numeric' => __('validation.exists'),
            'name.required' => __('validation.required'),
            'name.min' => __('validation.min.string'),
            'name.max' => __('validation.max.string'),
        ];
    }
}
