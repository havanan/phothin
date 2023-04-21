<?php

namespace Modules\Admin\Http\Requests\Admin;

use App\Base\Request\ApiRequest;

class PasswordUpdateRequest extends ApiRequest
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
            'new_password' => ['required', 'min:6', 'max:16'],
            'old_password' => ['required', 'min:6', 'max:16'],
            'password_confirmation' => ['required','min:6','max:16','same:new_password']
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => __('lang.api.user.profile.new_password_required'),
            'new_password.min' => __('lang.api.user.profile.new_password_min'),
            'new_password.max' => __('lang.api.user.profile.new_password_max'),
            'old_password.required' => __('lang.api.user.profile.old_password_required'),
            'old_password.min' => __('lang.api.user.profile.old_password_min'),
            'old_password.max' => __('lang.api.user.profile.old_password_max'),
            'password_confirmation.required' => __('lang.api.user.profile.confirm_password_required'),
            'password_confirmation.min' => __('lang.api.user.profile.confirm_password_min'),
            'password_confirmation.max' => __('lang.api.user.profile.confirm_password_max'),
            'password_confirmation.same' => __('lang.api.user.profile.confirm_password_same'),

        ];
    }
}
