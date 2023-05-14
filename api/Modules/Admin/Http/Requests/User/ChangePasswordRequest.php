<?php

namespace Modules\Admin\Http\Requests\User;

use App\Base\Request\ApiRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends ApiRequest
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
        $currentUser = auth('admin')->user();
        return [
            'user_id' => ['required', 'integer', function ($attribute, $value, $fail) use ($currentUser) {
                if ($value !== $currentUser->id) {
                    return $fail($attribute . ' không hợp lệ');
                }
            }],
            'old' => ['required', 'min:6', function ($attribute, $value, $fail) use ($currentUser) {
                if (!Hash::check($value, $currentUser->password)) {
                    return $fail($attribute . ' không hợp lệ');
                }
            }],
            'new' => ['required', 'min:6', 'same:re'],
            're' => ['required', 'min:6',],
        ];
    }

    public function messages()
    {
        return [
            'old.unique' => __('validation.unique'),
            'old.required' => __('validation.required'),
        ];
    }
}
