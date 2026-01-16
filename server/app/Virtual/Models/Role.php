<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *     schema="Role",
 *     title="Role",
 *     description="User Role model",
 * )
 */
class Role extends GenericModel
{
    /**
     * @OA\Property(
     *     title="Name",
     *     description="User Role name",
     *     type="string",
     *     example="volunteer",
     *     enum={"volounteer", "admin", "superadmin"}
     * )
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="Description",
     *     description="User Role description",
     *     type="string",
     *     example="Wolontariusz liczący",
     * )
     */
    public string $description;
}
