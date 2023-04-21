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
            'name' => ['required', 'min:1', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('lang.api.user.profile.name_required'),
            'name.min' => __('lang.api.user.profile.name_min'),
            'name.max' => __('lang.api.user.profile.name_max'),
        ];
    }
}
