import { createContext, useCallback, useContext, useEffect, useState } from 'react';
import { IDepositContext, BoxData } from '@/utils';

const clearBoxDataValues = {
  amounts: {
    count_1gr: null,
    count_2gr: null,
    count_5gr: null,
    count_10gr: null,
    count_20gr: null,
    count_50gr: null,
    count_1zl: null,
    count_2zl: null,
    count_5zl: null,
    count_10zl: null,
    count_20zl: null,
    count_50zl: null,
    count_100zl: null,
    count_200zl: null,
    count_500zl: null,
    amount_EUR: null,
    amount_USD: null,
    amount_GBP: null,
  },
  comment: '',
};

export const DepositContext = createContext<IDepositContext | null>(null);

export const useDepositContext = () => {
  const context = useContext(DepositContext);
  if (!context) {
    throw new Error('useDepositContext must be used within DepositContext.Provider');
  }
  return context;
};

export const useDepositContextValues = (defaultBoxData?: BoxData | null) => {
  const [boxData, setBoxData] = useState<BoxData>(defaultBoxData || clearBoxDataValues);

  useEffect(() => {
    if (defaultBoxData) setBoxData(defaultBoxData);
  }, [defaultBoxData]);

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

  const cleanAmounts = useCallback(() => {
    setBoxData(clearBoxDataValues);
  }, []);
  return {
    boxData,
    cleanAmounts,
    handleAmountsChange,
  };
};
