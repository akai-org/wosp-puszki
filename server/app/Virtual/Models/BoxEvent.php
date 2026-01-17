<?php
declare(strict_types=1);

namespace App\Virtual\Models;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *     title="BoxEvent",
 *     description="Box Event model",
 *     @OA\Xml(
 *         name="BoxEvent"
 *     )
 * )
 */
final class BoxEvent extends GenericModel
{
    /**
     * @OA\Property (
     *     title="Type",
     *     description="Box status",
     *     type="string",
     *     example="unverified"
     * )
     *
     * @example ['unverified', 'verified', 'give', 'found', startedCounting', 'updated', 'confirmed', give']
     * @var string
     */
    public string $type;  // todo change to enum type

    /**
     * @OA\Property(
     *     title="Charity Box",
     *     description="Charty box given to volunteer"
     * )
     *
     * @var CharityBox
     */
    public CharityBox $box;

    /**
     * @OA\Property(
     *     title="User",
     *     description="User model"
     * )
     *
     * @var User
     **/
    public User $user;

    /**
     * @OA\Property(
     *     title="Comment",
     *     description="Comment",
     *     type="string",
     *     example="Lorem ipsum"
     * )
     *
     * @var string
     **/
    public string $comment;

}
