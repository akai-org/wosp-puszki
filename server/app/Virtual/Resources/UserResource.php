<?php

declare(strict_types=1);

namespace App\Virtual\Resources;

use App\Virtual\Models\CharityBox;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *     title="User Resource",
 *     description="User resource",
 *     @OA\Xml(
 *         name="UserResource"
 *     )
 * )
 */
final class UserResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var CharityBox[]
     */
    // @phpstan-ignore property.unused
    private $data;
}
