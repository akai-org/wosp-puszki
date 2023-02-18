import { AmountsKeys, useAmountsQuery } from '@/utils';



export const moneyValues = {
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
  EUR: 4.71,
  GBP: 5.37,
  USD: 4.33,
};
export type moneyValuesType = typeof moneyValues;

export const sum = (amounts: Record<AmountsKeys, number>) => {
  let summ = 0;
  let i = 0;
  const values = Object.keys(moneyValues);
  for (const key in amounts) {
    summ +=
      amounts[key as AmountsKeys] * moneyValues[values[i] as keyof typeof moneyValues];
    i += 1;
  }
  return summ;
};
