<?php

declare(strict_types=1);

namespace App\Virtual\Models;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
final class User extends GenericModel
{
    /**
     * @OA\Property(
     *     title="Name",
     *     description="User's name",
     *     type="string",
     *     example="Jan"
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="Comment",
     *     description="Comment",
     *     type="string",
     *     example="Lorem ipsum"
     * )
     *
     * @var string
     */
    public string $comment;

    /**
     * @OA\Property(
     *     title="Token",
     *     description="",
     *     type="string",
     *     example=""
     * )
     *
     * @var string
     */
    public string $remember_token;
}
