import { createContext, useContext, useEffect, useState } from 'react';
import {
  IDepositContext,
  BoxData,
  AmountsKeys,
  ZlotyAmountsKeys,
  MONEY_VALUES,
  AMOUNTS_KEYS,
  ZLOTY_AMOUNTS_KEYS,
} from '@/utils';

export const DepositContext = createContext<IDepositContext | null>(null);

export const useDepositContext = () => {
  const context = useContext(DepositContext);
  if (!context) {
    throw new Error('useDepositContext must be used within DepositContext.Provider');
  }
  return context;
};

export const useDepositContextValues = () => {
  const [boxData, setBoxData] = useState<BoxData>({
    amounts: {
      count_1gr: 0,
      count_2gr: 0,
      count_5gr: 0,
      count_10gr: 0,
      count_20gr: 0,
      count_50gr: 0,
      count_1zl: 0,
      count_2zl: 0,
      count_5zl: 0,
      count_10zl: 0,
      count_20zl: 0,
      count_50zl: 0,
      count_100zl: 0,
      count_200zl: 0,
      count_500zl: 0,
      amount_EUR: 0,
      amount_USD: 0,
      amount_GBP: 0,
    },
    comment: '',
  });

  const [zlotySum, setZlotySum] = useState(0);
  const [total, setTotal] = useState(0);

  useEffect(() => {
    setZlotySum(sum(ZLOTY_AMOUNTS_KEYS));
    setTotal(sum(AMOUNTS_KEYS));
  }, [boxData]);

  const sum = (keys: AmountsKeys[] | ZlotyAmountsKeys[]) => {
    let total = 0;
    let i = 0;
    const values = Object.keys(MONEY_VALUES);
    for (const key in keys) {
      total +=
        boxData.amounts[keys[key]] * MONEY_VALUES[values[i] as keyof typeof MONEY_VALUES];
      i += 1;
    }
    return total;
  };

  const handleAmountsChange = (id: string, value: number | string) => {
    id != 'comment'
      ? setBoxData((prevBoxData) => ({
          ...prevBoxData,
          amounts: { ...prevBoxData.amounts, [id]: value },
        }))
      : setBoxData((prevBoxData) => ({
          ...prevBoxData,
          comment: value as string,
        }));
  };
  return {
    boxData,
    zlotySum,
    total,
    handleAmountsChange,
  };
};
