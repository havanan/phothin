<?php

namespace App\Base\Service;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;

class BaseService extends ServiceProvider
{
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
     * @param $data
     * @param string $message
     *
     * @return JsonResponse
     */
    public function statusNG($data = [], $message = '')
    {
        $response = ['status' => "NG", 'error' => true, 'data' => $data];

        if ($message) {
            $response['message'] = $message;
        }

        return new JsonResponse($response, HTTP_STATUS_BAD_REQUEST);
    }

    /**
     * permissionDeny
     * @param string $message
     *
     * @return JsonResponse
     */
    public function permissionDeny($message = '')
    {
        $response = ['status' => "NG", 'error' => true];
        $response['message'] = __('lang.api.permission_denied');
        if ($message) {
            $response['message'] = $message;
        }
        return new JsonResponse($response, HTTP_STATUS_FORBIDDEN);
    }

    /**
     * responseJson
     * @param $data
     * @param $status
     *
     * @return JsonResponse
     */
    public function responseJson($data = [], $status = HTTP_STATUS_SUCCESS)
    {
        return new JsonResponse($data, $status);
    }

    /**
     * fractalResponse
     * @param  mixed $data
     * @param  mixed $transformer
     * @return JsonResponse
     */
    public function fractalResponse($data, $transformer)
    {
        return fractal($data)->transformWith($transformer)->respond();
    }
}
