<?php
declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\JsonResponse;

class CollectorResource extends JsonResponse
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
