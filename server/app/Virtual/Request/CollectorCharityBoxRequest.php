<?php
declare(strict_types=1);

namespace App\Virtual\Request;

/**
 * @OA\Schema(
 *      title="",
 *      description="",
 *      type="object",
 *      required={"collector_identifier"}
 * )
 */
class CollectorCharityBoxRequest
{
    /**
     * @OA\Property(
     *      title="collector_identifier",
     *      description="Id of the collector identifier",
     *      format="int64",
     *      example="1"
     * )
     *
     * @var integer
     */
    public int $collector_identifier = 0;
}
