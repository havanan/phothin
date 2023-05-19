<?php

namespace App\Transformers;

use League\Fractal\Serializer\ArraySerializer;

class CustomSerializer extends ArraySerializer
{

    public function collection(?string $resourceKey, array $data): array
    {
        return ['data' => $data];
    }

    public function item(?string $resourceKey, array $data): array
    {
        return $data;
    }

    public function null(): ?array
    {
        return ['data' => []];
    }
}
