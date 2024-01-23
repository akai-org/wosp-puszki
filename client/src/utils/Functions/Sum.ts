import {
  BoxData,
  MONEY_AMOUNTS_VALUES,
  ZlotyAmountsKeys,
  AmountsKeys,
  ForeignAmountsKeys,
  moneyValuesType,
} from '@/utils';

export const sum = (
  boxData: BoxData,
  keys: ZlotyAmountsKeys[] | AmountsKeys[] | ForeignAmountsKeys[],
  moneyValues: moneyValuesType,
) => {
  let total = 0;

  for (const key in keys) {
    total +=
      boxData.amounts[keys[key]] *
      moneyValues[MONEY_AMOUNTS_VALUES[keys[key]] as keyof typeof moneyValues];
  }

  if (!isNaN(total)) return total;
  return Number(0);
};
