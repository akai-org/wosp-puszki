<?php

declare(strict_types=1);

namespace App\Virtual\Resources;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *     title="Box Event Resource",
 *     description="Box Event resource",
 *     @OA\Xml(
 *         name="BoxEventResource"
 *     )
 * )
 */
final class BoxEventResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\CharityBox[]
     */
    // @phpstan-ignore property.unused
    private $data;
}
