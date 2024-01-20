<?php

declare(strict_types=1);

namespace App\Virtual\Resources;

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
     * @var \App\Virtual\Models\CharityBox[]
     */
    private $data;
}