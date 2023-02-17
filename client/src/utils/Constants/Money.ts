import { AmountsKeys, ForeignAmountsKeys, ZlotyAmountsKeys } from '@/utils';

export const JEDEN_GR = 1.64;
export const DWA_GR = 2.13;
export const PIEC_GR = 2.59;
export const DZIESIEC_GR = 2.51;
export const DWADZIESCIA_GR = 3.22;
export const PIECDZIESIAT_GR = 3.94;
export const JEDEN_ZL = 5;
export const DWA_ZL = 5.21;
export const PIEC_ZL = 6.54;

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

export const AMOUNTS_KEYS: AmountsKeys[] = [
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
  'amount_EUR',
  'amount_USD',
  'amount_GBP',
];

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
