<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\JsonResponse;

class StationResource extends JsonResponse
{
    public function toArray($request)
    {
        // @phpstan-ignore staticMethod.notFound
        return parent::toArray($request);
    }
}
