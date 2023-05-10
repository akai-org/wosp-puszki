<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Lib\Rates\RatesFetcher;
use App\Utils\CurrencyEnum;
use App\Utils\RatesConverter\Converters\ConvertEurToPln;
use App\Utils\RatesConverter\Converters\ConvertGbpToPln;
use App\Utils\RatesConverter\Converters\ConvertUsdToPln;
use App\Utils\RatesFetcherFactory;
use Money\Currency;

/**
 * @author kabix09
 *
 * @OA\Tag(
 *     name="Rates",
 *     description="API Endpoints for currencies and rates"
 * )
 **/
final class RatesApiController extends ApiController
{
    /** @var RatesFetcher */
    private RatesFetcher $ratesFetcher;

    public function __construct()
    {
        $this->ratesFetcher = RatesFetcherFactory::config()::build();
    }

//* security={
//*          {"bearer_token":{}},
//*      },

    /**
     * @OA\Get(
     *      path="/currency/rates",
     *      operationId="getCurrencyRatesList",
     *      tags={"Rates"},
     *      summary="Get list of currencies rate",
     *      description="Return daily list of currency rate from NBP",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="rates",
     *                  type="array",
     *                  example={
     *                      "EUR": "4.71",
     *                      "USD": "4.42",
     *                      "GBP": "5.36",
     *                  },
     *                  @OA\Items(
     *                      @OA\Property(
     *                          property="EUR",
     *                          type="float",
     *                          example="4.71"
     *                      ),
     *                      @OA\Property(
     *                          property="USD",
     *                          type="float",
     *                          example="4.42"
     *                      ),
     *                      @OA\Property(
     *                          property="GBP",
     *                          type="float",
     *                          example="5.36"
     *                      )
     *                  )
     *              ),
     *          )
     *      ),
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
     */
    public function index()
    {
        return json_encode([
            'rates' => [
                'EUR' => (new ConvertEurToPln(0, new Currency(CurrencyEnum::defaultCurrency()->value)))->getRates(),
                'USD' => (new ConvertUsdToPln(0, new Currency(CurrencyEnum::defaultCurrency()->value)))->getRates(),
                'GBP' => (new ConvertGbpToPln(0, new Currency(CurrencyEnum::defaultCurrency()->value)))->getRates(),
            ]
        ]);
    }

    /**
     * @OA\Get(
     *      path="/currency/rates/{currency}",
     *      operationId="getCurrencyRate",
     *      tags={"Rates"},
     *      summary="Get currency rate",
     *      description="Return daily currency rate from NBP",
     *      @OA\Parameter(
     *          name="currency",
     *          description="Currency code",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="rates",
     *                  type="float",
     *                  example="4.58"
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
     */
    public function show(string $currency)
    {
        $currency = CurrencyEnum::tryFrom(strtoupper($currency));

        if($currency === null)
            throw new \InvalidArgumentException(sprintf('Invalid currency name: %s', $currency));
        else if($currency == CurrencyEnum::defaultCurrency())
            return json_encode(["rates" => 1, "message" => "It's default currency. The rates PLN to PLN is always 1"]);

        return json_encode(["rates" => round((float)$this->ratesFetcher->fetchRates($currency)->current(), 2)]);
    }

}
