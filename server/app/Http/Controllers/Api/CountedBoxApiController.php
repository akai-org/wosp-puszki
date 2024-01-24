<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Utils\CurrencyEnum;
use App\Utils\DisplayFormat\Format\CurrencyWithCommaFormat;
use App\Utils\MoneyCounter\CollectedMoneyCounter;
use App\Utils\MoneyCounter\ConfirmedMoneyCounter;
use App\Utils\MoneyCounter\MoneyCounter;
use Illuminate\Http\Response;
use InvalidArgumentException;
use OpenApi\Annotations as OA;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Webmozart\Assert\Assert;

/**
 * @author kabix09
 *
 * @OA\Tag(
 *     name="CharityBoxScore",
 *     description="API Endpoints for currencies and rates"
 * )
 **/
final class CountedBoxApiController extends ApiController
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @OA\Get(
     *     path="/charityBoxes/count/collected",
     *     operationId="getCollectedCharityBox",
     *     tags={"CharityBoxScore"},
     *     summary="Get bucket of collected money",
     *     description="Return bucket of collecteed money each sum in oryginal currency",
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="PLN",
     *                  type="float",
     *                  example="43 237,46"
     *              ),
     *              @OA\Property(
     *                  property="EUR",
     *                  type="float",
     *                  example="40,46"
     *              ),
     *              @OA\Property(
     *                  property="USD",
     *                  type="float",
     *                  example="30,82"
     *              ),
     *              @OA\Property(
     *                  property="GBP",
     *                  type="float",
     *                  example="41,85"
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @return string
     */
    public function collected()
    {
        $mc = new CollectedMoneyCounter();

        return json_encode([
            CurrencyEnum::PLN_NAME->value => (string)(new CurrencyWithCommaFormat($mc->getPln())), // wantedFormat($amount_PLN),
            CurrencyEnum::EUR_NAME->value => (string)(new CurrencyWithCommaFormat($mc->getEur())),
            CurrencyEnum::USD_NAME->value => (string)(new CurrencyWithCommaFormat($mc->getUsd())),
            CurrencyEnum::GBP_NAME->value => (string)(new CurrencyWithCommaFormat($mc->getGbp())),
        ]);
    }

    /**
     * @OA\Get(
     *     path="/charityBoxes/count/collected/sum",
     *     operationId="getSumOfCollectedCharityBox",
     *     tags={"CharityBoxScore"},
     *     summary="Get sum of collected money in default currency",
     *     description="Return sum of collected money in default currency",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  type="string",
     *                  property="total_in_pln",
     *                  example="43 788,86"
     *              ),
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @return string
     */
    public function collectedAmountOfMoney(CollectedMoneyCounter $mc)
    {
        return $this->getCollectedAmount($mc);
    }

    /**
     * @OA\Get(
     *     path="/charityBoxes/count/collected/{currency}",
     *     operationId="getCollectedCharityBoxByCurrency",
     *     tags={"CharityBoxScore"},
     *     summary="Get amount of money collected in specify currency",
     *     description="Return amount of money collected in specify currency",
     *     @OA\Parameter(
     *          name="currency",
     *          description="Currency code",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="PLN",
     *                  type="float",
     *                  example="43 237,46"
     *              )
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @return string
     * @throws ReflectionException
     */
    public function collectedAmountOfMoneyByCurrency(string $currency, CollectedMoneyCounter $mc)
    {
        /** @var CurrencyEnum|string $currency */
        return $this->getCollectedSumByCurrency($currency, $mc);
    }


    /**
     * @OA\Get(
     *     path="/charityBoxes/count/confirmed",
     *     operationId="getConfirmedCharityBoxSum",
     *     tags={"CharityBoxScore"},
     *     summary="Get sum of collected money",
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="PLN",
     *                  type="float",
     *                  example="30 950,00"
     *              ),
     *              @OA\Property(
     *                  property="EUR",
     *                  type="float",
     *                  example="27,00"
     *              ),
     *              @OA\Property(
     *                  property="USD",
     *                  type="float",
     *                  example="20,00"
     *              ),
     *              @OA\Property(
     *                  property="GBP",
     *                  type="float",
     *                  example="26,00"
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @return string
     */
    public function confirmed()
    {
        $mc = new ConfirmedMoneyCounter();

        return json_encode([
            CurrencyEnum::PLN_NAME->value => (string)(new CurrencyWithCommaFormat($mc->getPln())), // wantedFormat($amount_PLN),
            CurrencyEnum::EUR_NAME->value => (string)(new CurrencyWithCommaFormat($mc->getEur())),
            CurrencyEnum::USD_NAME->value => (string)(new CurrencyWithCommaFormat($mc->getUsd())),
            CurrencyEnum::GBP_NAME->value => (string)(new CurrencyWithCommaFormat($mc->getGbp())),
        ]);
    }

    /**
     * @OA\Get(
     *     path="/charityBoxes/count/confirmed/sum",
     *     operationId="getSumOfConfirmedCharityBox",
     *     tags={"CharityBoxScore"},
     *     summary="Get sum of confirmed money in default currency",
     *     description="Return sum of confirmed money in default currency",
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  type="string",
     *                  property="total_in_pln",
     *                  example="31 788,86"
     *              ),
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @return string
     */
    public function confirmedAmountOfMoney(ConfirmedMoneyCounter $mc)
    {
        return $this->getCollectedAmount($mc);
    }

    /**
     * @OA\Get(
     *     path="/charityBoxes/count/confirmed/{currency}",
     *     operationId="getConfirmedCharityBoxSumByCurrency",
     *     tags={"CharityBoxScore"},
     *     summary="Get amount of money in specified currency",
     *     description="Return amount of money in specified currency",
     *     @OA\Parameter(
     *          name="currency",
     *          description="Currency code",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  type="string",
     *                  property="USD",
     *                  example="20,00"
     *              ),
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     * @return string
     */
    public function confirmedAmountOfMoneyByCurrency(string $currency, ConfirmedMoneyCounter $mc)
    {
        /** @var CurrencyEnum|string $currency */
        return $this->getCollectedSumByCurrency($currency, $mc);
    }



    /**
     * @param CurrencyEnum|string $currency
     * @param MoneyCounter $mc
     * @return false|string
     * @throws ReflectionException
     */
    private function getCollectedSumByCurrency(CurrencyEnum|string $currency, MoneyCounter $mc): string|false
    {
        try {
            $currency = CurrencyEnum::tryFrom(strtoupper($currency));

            if ($currency === null)
                throw new InvalidArgumentException(sprintf('Invalid currency name: %s', $currency));

            $currencyGetterName = sprintf('get%s', ucfirst(strtolower($currency->value)));

            // Test - check did build getter name exists in money counter class
            Assert::inArray(
                $currencyGetterName,
                array_map(function (ReflectionMethod $methodsSchema) {
                    return $methodsSchema->getName();
                }, (new ReflectionClass($mc::class))->getMethods(ReflectionMethod::IS_PUBLIC))
            );
        }catch (\Exception $e) {
            return json_encode([
                'message' => $e->getMessage(),
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }


        return json_encode([
            $currency->value => (string)(new CurrencyWithCommaFormat($mc->$currencyGetterName())),
        ]);
    }

    /**
     * @param MoneyCounter $mc
     * @return string
     */
    private function getCollectedAmount(MoneyCounter $mc): string
    {
        /** @var string $key
         * Dynamically built key name based on the default currency setting in the project configuration
         */
        $key = sprintf('total_in_%s', strtolower(CurrencyEnum::defaultCurrency()->value));

        /** @var string $value
         * Return sum of all collected money converted into a common currency in specify format
         */
        $value = (string)(new CurrencyWithCommaFormat($mc->count()));

        return json_encode([$key => $value]);
    }
}
