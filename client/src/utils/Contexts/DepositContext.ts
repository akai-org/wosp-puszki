import { createContext, useContext, useState } from 'react';
import { IDepositContext, BoxData } from '@/utils';

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

  const cleanAmounts = () => {
    setBoxData({
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
  };
  return {
    boxData,
    cleanAmounts,
    handleAmountsChange,
  };
};
