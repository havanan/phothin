<?php

namespace App\Base\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

// Any api request must extends this class
abstract class ApiRequest extends LaravelFormRequest
{
    protected $logRequestError = false;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errorCode = '';
        if (method_exists($this, 'getErrorCode')) {
            $errorCode = $this->getErrorCode($validator->failed());
        }
        throw new HttpResponseException(
            $this->statusNG($validator->errors(), __('lang.api.bad_request'), $errorCode)
        );
    }

    /**
     * getValidatorInstance
     *
     * @return void
     */
    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function (Validator $validator) {
            if ($this->logRequestError && !empty($validator->errors()->getMessages())) {
                Log::error(request()->all());
            }
            if (method_exists($this, 'customAfterValidate') && !$validator->errors()->getMessages()) {
                $this->customAfterValidate($validator);
            }
        });
    }

    /**
     * statusOK
     * @param $data
     * @param string $message
     *
     * @return JsonResponse
     */
    public function statusOK($data = [], $message = '')
    {
        $response = ['status' => "OK", 'data' => $data];

        if ($message) {
            $response['message'] = $message;
        }

        return new JsonResponse($response, HTTP_STATUS_SUCCESS);
    }

    /**
     * statusNG
     * @param $error
     * @param string $message
     * @param string $errorCode
     *
     * @return JsonResponse
     */
    public function statusNG($errors, $message = '', $errorCode = '')
    {
        $response = ['status' => "NG", 'error' => true];
        if ($message) {
            $response['message'] = $message;
        }
        $response['data'] = [];
        if ($errorCode) {
            $response['data'] = [
                'error_code' => $errorCode,
            ];
        }

        if (!empty($errors)) {
            $response['data']['errors'] = $errors;
        }

        return new JsonResponse($response, HTTP_STATUS_BAD_REQUEST);
    }
}
