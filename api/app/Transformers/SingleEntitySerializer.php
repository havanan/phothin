<?php

namespace App\Transformers;

use League\Fractal\Serializer\ArraySerializer;

class SingleEntitySerializer extends ArraySerializer
{
    public function collection($resourceKey, array $data)
    {
        return $data;
    }

    public function item($resourceKey, array $data)
    {
        return $data;
    }

    public function null()
    {
        return ['data' => []];
    }
}
