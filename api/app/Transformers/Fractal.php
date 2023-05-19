<?php

namespace App\Transformers;

use Illuminate\Http\JsonResponse;
use Spatie\Fractal\Fractal as FractalisticFractal;

class Fractal extends FractalisticFractal
{
    /**
     * Return a new JSON response.
     *
     * @param  callable|int $statusCode
     * @param  callable|array $headers
     * @param  callable|int $options
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($statusCode = 200, $headers = [], $options = 0)
    {
        $response = new JsonResponse();


        if (is_int($statusCode)) {
            $statusCode = function (JsonResponse $response) use ($statusCode) {
                return $response->setStatusCode($statusCode);
            };
        }

        if (is_array($headers)) {
            $headers = function (JsonResponse $response) use ($headers) {
                return $response->withHeaders($headers);
            };
        }

        if (is_int($options)) {
            $options = function (JsonResponse $response) use ($options) {
                $response->setEncodingOptions($options);

                return $response;
            };
        }

        if (is_callable($options)) {
            $options($response);
        }

        if (is_callable($statusCode)) {
            $statusCode($response);
        }

        if (is_callable($headers)) {
            $headers($response);
        }

        $data['status'] = 'OK';
        if (intval($response->getStatusCode()) > 299) {
            $data['status'] = 'NG';
            $data['error'] = true;
        }
        $setData = array_merge($data, $this->createData()->toArray());
        $response->setData($setData);

        return $response;
    }

    /**
     * addMeta
     *
     * @param  array $data
     * @return self
     */
    public function addMeta(array $data = [])
    {
        $this->meta += $data;
        return $this;
    }
}
