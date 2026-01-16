<?php

declare(strict_types=1);

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *     schema="Station",
 *     title="Station",
 *     description="Station model - ",
 * )
 */
final class Station
{
    /**
     * @OA\Property(
     *     title="Station",
     *     description="Station number",
     *     type="integer",
     *     example="1"
     * )
     */
    public int $station;

    /**
     * @OA\Property(
     *     title="Stationary status",
     *     description="Stationary status- active: 1, inactive: 0",
     *     type="bit",
     *     example="1"
     * )
     */
    public int $status;

    /**
     * @OA\Property(
     *     title="Stationary time",
     *     description="Stationary status- active: 1, inactive: 0",
     *     type="datetime",
     *     example="2023-12-06 12:38:42"
     * )
     */
    public ?\DateTime $time;
}
