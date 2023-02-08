import { useContext, useState } from 'react';
import { createContext, ReactNode } from 'react';

export const DepositContext = createContext<IDepositContext | null>(null);

export type AmountsKeys =
  | 'count_1gr'
  | 'count_2gr'
  | 'count_5gr'
  | 'count_10gr'
  | 'count_20gr'
  | 'count_50gr'
  | 'count_1zl'
  | 'count_2zl'
  | 'count_5zl'
  | 'count_10zl'
  | 'count_20zl'
  | 'count_50zl'
  | 'count_100zl'
  | 'count_200zl'
  | 'count_500zl'
  | 'amount_EUR'
  | 'amount_USD'
  | 'amount_GBP';
export interface BoxData {
  amounts: Record<AmountsKeys, number>;
  comment: string;
}

export interface IDepositContext {
  boxData: BoxData;
  setBoxData: React.Dispatch<React.SetStateAction<BoxData>>;
}

interface ProviderProps {
  children: ReactNode;
}

export const DepositProvider: React.FC<ProviderProps> = ({ children }) => {
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

  return (
    <DepositContext.Provider value={{ boxData, setBoxData }}>
      {children}
    </DepositContext.Provider>
  );
};


const moneyValues = {
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


export const useDepositContext = () => {
  const context = useContext(DepositContext);
  if (!context) {
    throw new Error('useDepositContext must be used within DepositContext.Provider');
  }
  const { boxData, setBoxData } = context;

  function sum(amounts: Record<AmountsKeys, number>) {
    let summ = 0;
    let i = 0;
    const values = Object.keys(moneyValues);
    for (const key in amounts) {
      summ +=
        amounts[key as AmountsKeys] * moneyValues[values[i] as keyof typeof moneyValues];
      i += 1;
    }
    return summ;
  }

  const handleAmountsChange = (id: string, value: number | string) => {
    console.log(value);
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
  return { boxData, handleAmountsChange, sum, moneyValues };
};

export type useDepositContextType = ReturnType<typeof useDepositContext>;
