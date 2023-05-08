<?php
declare(strict_types=1);

namespace App\Lib\Rates;

use App\Utils\CurrencyEnum;
use Illuminate\Contracts\Support\Arrayable;

// TODO ZREAKTORYZOWAĆ - niech klasa buduje zmienne dpowiadające poszczególnym walutom na podst enum CurrencyEnum
// w przypadku dodania nowej waluty rozbudowa będiz emniej kłopotliwa
// spróbować z kalsami ArrayAccess i opeatorem 'splat' w konstruktorze (albo ReflectionClass)
class Rates implements Arrayable
{

    // TODO można jakoś hintować typy tych zmiennych? Czy z api i configa lecą te same typy?
    private $gbp;
    private $eur;
    private $usd;

    public function __construct($usd, $eur, $gbp)
    {
        $this->usd = $usd;
        $this->eur = $eur;
        $this->gbp = $gbp;
    }

    public function toArray(): array
    {
        return [
            CurrencyEnum::USD_NAME->value => $this->usd,
            CurrencyEnum::EUR_NAME->value => $this->eur,
            CurrencyEnum::GBP_NAME->value => $this->gbp
        ];
    }
}
