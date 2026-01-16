<?php

namespace App\Virtual\Models;

use OpenApi\Annotations as OA;

/**
 * @author kabix09
 *
 * @OA\Schema(
 *     schema="Collector",
 *     title="Collector",
 *     description="Collector model - volunter with charity box",
 * )
 */
final class Collector extends GenericModel
{
    /**
     * @OA\Property(
     *     title="Identifier",
     *     description="Volunteer ID number (number from the volunteer's badge)",
     *     type="string",
     *     example="123"
     * )
     */
    public string $identifier;

    /**
     * @OA\Property(
     *     title="First Name",
     *     description="Volunteer's name",
     *     type="string",
     *     example="Jan"
     * )
     */
    public string $first_name;

    /**
     * @OA\Property(
     *     title="Last Name",
     *     description="Volunteer's last name",
     *     type="string",
     *     example="Kowalski"
     * )
     */
    public string $last_name;

    /**
     * @OA\Property(
     *     title="Phone Number",
     *     description="Volunteer's phone number",
     *     type="string",
     *     example="123456789"
     * )
     */
    public string $phone_number;
}
