<?php

namespace App\Virtual\Request;

use Money\Money;

/**
 * @OA\Schema(
 *      title="",
 *      description="",
 *      type="object",
 *      required={"box_id"}
 * )
 */
class UpdateCharityBoxRequest extends BoxCharityBoxRequest
{
    /**
     * @OA\Property(
     *     title="Count_1gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=120
     * )
     *
     * @var integer
     */
    public int $count_1gr;

    /**
     * @OA\Property(
     *     title="Count_2gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=245
     * )
     *
     * @var integer
     */
    public int $count_2gr;

    /**
     * @OA\Property(
     *     title="Count_5gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=300
     * )
     *
     * @var integer
     */
    public int $count_5gr;

    /**
     * @OA\Property(
     *     title="Count_10gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=120
     * )
     *
     * @var integer
     */
    public int $count_10gr;

    /**
     * @OA\Property(
     *     title="Count_20gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=80
     * )
     *
     * @var integer
     */
    public int $count_20gr;

    /**
     * @OA\Property(
     *     title="Count_50gr",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     *
     * @var integer
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
     *
     * @var integer
     */
    public int $count_2zl;

    /**
     * @OA\Property(
     *     title="Count_5zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    public int $count_5zl;

    /**
     * @OA\Property(
     *     title="Count_10zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    public int $count_10zl;

    /**
     * @OA\Property(
     *     title="Count_20zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    public int $count_20zl;

    /**
     * @OA\Property(
     *     title="Count_50zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    public int $count_50zl;

    /**
     * @OA\Property(
     *     title="Count_100zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    public int $count_100zl;

    /**
     * @OA\Property(
     *     title="Count_200zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    public int $count_200zl;

    /**
     * @OA\Property(
     *     title="Count_500zl",
     *     description="Number of coins",
     *     type="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    public int $count_500zl;


    /**
     * @OA\Property(
     *     title="Amount PLN",
     *     description="Sum of collected money",
     *     type="int64",
     *     example=60
     * )
     *
     * @var float
     */
    public float $amount_PLN;

    /**
     * @OA\Property(
     *     title="Amount EUR",
     *     description="Sum of collected money",
     *     type="int64",
     *     example=60
     * )
     *
     * @var float
     */
    public float $amount_EUR;

    /**
     * @OA\Property(
     *     title="Amount USD",
     *     description="Sum of collected money",
     *     type="int64",
     *     example=60
     * )
     *
     * @var float
     */
    public float $amount_USD;

    /**
     * @OA\Property(
     *     title="Amount GBP",
     *     description="Sum of collected money",
     *     type="int64",
     *     example=60
     * )
     *
     * @var float
     */
    public float $amount_GBP;

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
}
