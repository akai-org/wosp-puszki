import { ReactNode } from 'react';
import { useBoxContextValues, useDepositContextValues } from '@/utils';
import { BoxContext } from './BoxContext';
import { DepositContext } from './DepositContext';

interface ProviderProps {
  children: ReactNode;
}

export const SettleProcessProvider: React.FC<ProviderProps> = ({ children }) => {
  const boxValues = useBoxContextValues();
  const depositValues = useDepositContextValues();

  return (
    <DepositContext.Provider value={depositValues}>
      <BoxContext.Provider value={boxValues}>{children}</BoxContext.Provider>
    </DepositContext.Provider>
  );
};
