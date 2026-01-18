<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\JsonResponse;

class CharityBoxResource extends JsonResponse
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(string $request): array
    {
        // @phpstan-ignore staticMethod.notFound
        return parent::toArray($request);
    }
}
