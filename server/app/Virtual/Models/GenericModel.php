<?php
declare(strict_types=1);

namespace App\Virtual\Models;

use App\Virtual\Triat\Timestampable;

abstract class GenericModel
{
    use Timestampable;

    /**
     * @OA\Property(
     *     title="ID",
     *     description="Primary Key",
     *     type="integer",
     *     example=1
     * )
     *
     * @var integer
     */
    // @phpstan-ignore property.unused
    private int $id;
}
