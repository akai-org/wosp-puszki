<?php
declare(strict_types=1);

namespace App\Virtual\Request;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Charity Box request",
 *      description="Charity Box request body data",
 *      type="object",
 *      required={"box_id"}
 * )
 */
class BoxCharityBoxRequest
{
    /**
     * @OA\Property(
     *      title="box_id",
     *      description="Id of the box to unverify",
     *      format="int64",
     *      example="1"
     * )
     *
     * @var integer
     */
    public int $box_id = 0;
}