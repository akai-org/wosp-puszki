<?php

declare(strict_types=1);

namespace App\Virtual\Resources;

use App\Virtual\Models\CharityBox;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *     title="Collector Resource",
 *     description="Collector resource",
 *     @OA\Xml(
 *         name="CollectorResource"
 *     )
 * )
 */
final class CollectorResource
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
