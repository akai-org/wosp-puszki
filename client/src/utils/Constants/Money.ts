import { AmountsKeys, ForeignAmountsKeys, ZlotyAmountsKeys } from '@/utils';

// Money mass
export const ONE_GR_MASS_IN_GRAMS = 1.64;
export const TWO_GR_MASS_IN_GRAMS = 2.13;
export const FIVE_GR_MASS_IN_GRAMS = 2.59;
export const TEN_GR_MASS_IN_GRAMS = 2.51;
export const TWENTY_GR_MASS_IN_GRAMS = 3.22;
export const FIFTY_GR_MASS_IN_GRAMS = 3.94;
export const ONE_ZL_MASS_IN_GRAMS = 5;
export const TWO_ZL_MASS_IN_GRAMS = 5.21;
export const FIVE_ZL_MASS_IN_GRAMS = 6.54;

export const MONEY_VALUES = {
  '1gr': 0.01,
  '2gr': 0.02,
  '5gr': 0.05,
  '10gr': 0.1,
  '20gr': 0.2,
  '50gr': 0.5,
  '1zł': 1,
  '2zł': 2,
  '5zł': 5,
  '10zł': 10,
  '20zł': 20,
  '50zł': 50,
  '100zł': 100,
  '200zł': 200,
  '500zł': 500,
  EUR: 4.76,
  GBP: 5.36,
  USD: 4.45,
};

export const MONEY_AMOUNTS_VALUES = {
  count_1gr: '1gr',
  count_2gr: '2gr',
  count_5gr: '5gr',
  count_10gr: '10gr',
  count_20gr: '20gr',
  count_50gr: '50gr',
  count_1zl: '1zł',
  count_2zl: '2zł',
  count_5zl: '5zł',
  count_10zl: '10zł',
  count_20zl: '20zł',
  count_50zl: '50zł',
  count_100zl: '100zł',
  count_200zl: '200zł',
  count_500zl: '500zł',
  amount_EUR: 'EUR',
  amount_USD: 'GBP',
  amount_GBP: 'USD',
};

export const FOREIGN_AMOUNTS_KEYS: ForeignAmountsKeys[] = [
  'amount_EUR',
  'amount_USD',
  'amount_GBP',
];

export const ZLOTY_AMOUNTS_KEYS: ZlotyAmountsKeys[] = [
  'count_1gr',
  'count_2gr',
  'count_5gr',
  'count_10gr',
  'count_20gr',
  'count_50gr',
  'count_1zl',
  'count_2zl',
  'count_5zl',
  'count_10zl',
  'count_20zl',
  'count_50zl',
  'count_100zl',
  'count_200zl',
  'count_500zl',
];

export const AMOUNTS_KEYS: AmountsKeys[] = [
  ...ZLOTY_AMOUNTS_KEYS,
  ...FOREIGN_AMOUNTS_KEYS,
];
