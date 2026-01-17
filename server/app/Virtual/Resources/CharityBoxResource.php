<?php

declare(strict_types=1);

namespace App\Virtual\Resources;

use App\Virtual\Models\CharityBox;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *     title="Charity Box Resource",
 *     description="Charity Box resource",
 *     @OA\Xml(
 *         name="CharityBoxResource"
 *     )
 * )
 */
final class CharityBoxResource
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
