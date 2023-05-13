<?php

namespace Modules\Admin\Http\Requests\User;

use App\Base\Request\ApiRequest;

class UpdateUserRequest extends ApiRequest
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
        $userId = request('id');
        return [
            'phone' => 'required|unique:users,phone,' . $userId,
        ];
    }

    public function messages()
    {
        return [
            'phone.unique' => __('validation.unique'),
            'phone.required' => __('validation.required'),
        ];
    }
}
