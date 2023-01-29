import { Dispatch, SetStateAction, useContext, useState } from 'react';
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
  setBoxData: Dispatch<SetStateAction<BoxData>>;
}

interface ProviderProps {
  children: ReactNode;
}

export const DepositProvider: React.FC<ProviderProps> = ({ children }) => {
  const [boxData, setBoxData] = useState<BoxData>({
    amounts: {
      count_1gr: 0,
      count_2gr: 0,
      count_2zl: 0,
      count_5gr: 0,
      count_5zl: 0,
      count_1zl: 0,
      count_10zl: 0,
      count_20gr: 0,
      count_10gr: 0,
      count_50gr: 0,
      count_50zl: 0,
      count_100zl: 0,
      amount_EUR: 0,
      count_20zl: 0,
      count_200zl: 0,
      count_500zl: 0,
      amount_GBP: 0,
      amount_USD: 0,
    },
    comment: '',
  });

  return (
    <DepositContext.Provider value={{ boxData, setBoxData }}>
      {children}
    </DepositContext.Provider>
  );
};

export const useDepositContext = () => {
  const context = useContext(DepositContext);
  if (!context) {
    throw new Error('useDepositContext must be used within DepositContext.Provider');
  }
  return context;
};
