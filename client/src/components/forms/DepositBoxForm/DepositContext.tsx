import { BoxData, IDepositContext } from '@/utils';
import { useContext, useState } from 'react';
import { createContext, ReactNode } from 'react';

export const DepositContext = createContext<IDepositContext | null>(null);


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
  return (
    <DepositContext.Provider value={{ boxData, handleAmountsChange }}>
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

export type useDepositContextType = ReturnType<typeof useDepositContext>;
