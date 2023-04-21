<?php

namespace App\Base\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class BaseController extends Controller
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
}
