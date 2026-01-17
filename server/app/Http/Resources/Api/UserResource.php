<?php
declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\JsonResponse;

class UserResource extends JsonResponse
{
    /**
     * @param string $request
     * @return array<string, mixed>
     */
    public function toArray(string $request): array
    {
        // @phpstan-ignore staticMethod.notFound
        return parent::toArray($request);
    }
}
