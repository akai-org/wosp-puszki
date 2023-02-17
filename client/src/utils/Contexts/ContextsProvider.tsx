import { ReactNode } from 'react';
import {
  useAuthContextValues,
  useBoxContextValues,
  useDepositContextValues,
} from '@/utils';
import { AuthContext } from './AuthContext';
import { BoxContext } from './BoxContext';
import { DepositContext } from './DepositContext';

interface ProviderProps {
  children: ReactNode;
}

export const ContextsProvider: React.FC<ProviderProps> = ({ children }) => {
  const authValues = useAuthContextValues();
  const boxValues = useBoxContextValues();
  const depositValues = useDepositContextValues();

  return (
    <>
      <AuthContext.Provider value={authValues}>
        <DepositContext.Provider value={depositValues}>
          <BoxContext.Provider value={boxValues}>{children}</BoxContext.Provider>
        </DepositContext.Provider>
      </AuthContext.Provider>
    </>
  );
};
