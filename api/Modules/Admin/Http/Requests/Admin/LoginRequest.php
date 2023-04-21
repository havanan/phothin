<?php

namespace Modules\Admin\Http\Requests\Admin;

use App\Base\Request\ApiRequest;
use App\Models\Admin;
use Illuminate\Validation\Rule;

class LoginRequest extends ApiRequest
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
            'email' => [
                'required',
                'email',
                Rule::exists('admins', 'email')->where(function ($query) {
                    return $query->whereStatus(Admin::ACTIVE)
                        ->whereNull('deleted_at');
                }),
            ],
            'password' => ['required', 'min:6', 'max:16'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('lang.api.user.profile.email_required'),
            'email.email' => __('lang.api.user.profile.email_type'),
            'email.exists' => __('lang.api.user.inactive'),
            'password.required' => __('lang.api.user.profile.password_required'),
            'password.min' => __('lang.api.user.profile.password_min'),
            'password.max' => __('lang.api.user.profile.password_max'),
        ];
    }
}
