<?php
declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\JsonResponse;

class CharityBoxResource extends JsonResponse
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
