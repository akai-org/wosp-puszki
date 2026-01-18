<?php

namespace App\Virtual\Models;

use Money\Money;

/**
 * @OA\Schema(
 *     title="CharityBox",
 *     description="CharityBox model",
 *
 *     @OA\Xml(
 *         name="CharityBox"
 *     )
 * )
 */
final class CharityBox extends GenericModel
{
    /**
     * @OA\Property(
     *     title="Collector Identifier",
     *     description="Identifier of volunteer's identification badge",
     *     format="int64",
     *     type="integer",
     *     example=299
     * )
     */
    public int $collectorIdentifier;

    /**
     * @OA\Property(
     *     title="Is Given To Collector",
     *     description="Flag whether charity box has been issued",
     *     type="boolean",
     *     example=1
     * )
     */
    public bool $is_given_to_collector;
    /**
     * @OA\Property(
     *     title="Given To Collector User",
     *     description="User giving charity box to volunter id",
     * )
     *
     * @vav User
     */
    public User $given_to_collector_user_id;
    /**
     * @OA\Property(
     *     title="Time Given",
     *     description="Time of giving charity box to volunter",
     *     format="datetime",
     *     type="string",
     *     example="2023-03-18 10:22:25.323"
     * )
     *
     * @var \DateTime
     */
    public $time_given;
    /**
     * @OA\Property(
     *     title="Is Counted",
     *     description="Flag whether charity box were counted",
     *     type="boolean",
     *     example=0
     * )
     */
    public bool $is_counted;
    /**
     * @OA\Property(
     *     title="Counting User",
     *     description="Id of user counting charity box",
     * )
     */
    public User $counting_user_id;
    /**
     * @OA\Property(
     *     title="Time Counted",
     *     description="Time of settlement charity box",
     *     format="datetime",
     *     type="string",
     *     example="2023-03-18 10:22:25.323"
     * )
     *
     * @var \DateTime
     */
    public $time_counted;
    /**
     * @OA\Property(
     *     title="Is Confirmed",
     *     description="Flag wheteher settlement of charity box were confirmed by other person",
     *     type="bool"
     * )
     *
     * @var bool
     */
    public $is_confirmed;
    /**
     * @OA\Property(
     *     title="User Confirmed",
     *     description="Id of user who confirmed charity box settlement",
     *     type="integer"
     * )
     */
    public User $user_confirmed_id;
    /**
     * @OA\Property(
     *     title="TimeConfirmed",
     *     description="Date confirmation of charity box settlement",
     *     format="datetime",
     *     type="string",
     *     example="2023-03-18 9:57:30.196"
     * )
     *
     * @var \DateTime
     */
    public $time_confirmed;
    /**
     * @OA\Property(
     *     title="Count_1gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=120
     * )
     */
    public int $count_1gr;
    /**
     * @OA\Property(
     *     title="Count_2gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=245
     * )
     */
    public int $count_2gr;
    /**
     * @OA\Property(
     *     title="Count_5gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=300
     * )
     */
    public int $count_5gr;
    /**
     * @OA\Property(
     *     title="Count_10gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=120
     * )
     */
    public int $count_10gr;
    /**
     * @OA\Property(
     *     title="Count_20gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=80
     * )
     */
    public int $count_20gr;
    /**
     * @OA\Property(
     *     title="Count_50gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     */
    public int $count_50gr;
    /**
     * @OA\Property(
     *     title="Count_1zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     *
     * @var int
     */
    public $count_1zl;
    /**
     * @OA\Property(
     *     title="Count_2zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     */
    public int $count_2zl;
    /**
     * @OA\Property(
     *     title="Count_5zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     */
    public int $count_5zl;
    /**
     * @OA\Property(
     *     title="Count_10zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     */
    public int $count_10zl;
    /**
     * @OA\Property(
     *     title="Count_20zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     */
    public int $count_20zl;
    /**
     * @OA\Property(
     *     title="Count_50zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     */
    public int $count_50zl;
    /**
     * @OA\Property(
     *     title="Count_100zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     */
    public int $count_100zl;
    /**
     * @OA\Property(
     *     title="Count_200zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     */
    public int $count_200zl;
    /**
     * @OA\Property(
     *     title="Count_500zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     */
    public int $count_500zl;
    /**
     * @OA\Property(
     *     title="Amount PLN",
     *     description="Sum of collected money",
     *     type="int64",
     *     example=60
     * )
     */
    public float $amount_PLN;
    /**
     * @OA\Property(
     *     title="Amount EUR",
     *     description="Sum of collected money",
     *     type="int64",
     *     example=60
     * )
     */
    public Money $amount_EUR;
    /**
     * @OA\Property(
     *     title="Amount USD",
     *     description="Sum of collected money",
     *     type="int64",
     *     example=60
     * )
     */
    public Money $amount_USD;
    /**
     * @OA\Property(
     *     title="Amount GBP",
     *     description="Sum of collected money",
     *     type="int64",
     *     example=60
     * )
     */
    public Money $amount_GBP;
    /**
     * @OA\Property(
     *     title="Comment",
     *     description="Comment",
     *     type="string",
     *     example="Lorem ipsum"
     * )
     */
    public string $comment;
    /**
     * @OA\Property(
     *     title="Is Special Box",
     *     description="Flag whether charity box is a special one",
     *     type="bool",
     *     example=0
     * )
     */
    public bool $is_special_box;

    // @phpstan-ignore property.unused
    private Collector $collector;
}
