import { ReactNode } from 'react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { BrowserRouter } from 'react-router-dom';
import {
  getBaseAuthContextValues,
  getBaseBoxContextValues,
  getBaseDepositContextValues,
} from './basicMockupValues';
import {
  AuthProviderConfig,
  BoxProviderConfig,
  DepositProviderConfig,
  Providers,
} from './types';
import { DepositContext } from '@components/forms/DepositBoxForm/DepositContext';
import { AuthContext, BoxContext } from '@/App';

export const BaseProvider = ({ children }: { children: ReactNode }) => {
  const queryClient = new QueryClient();
  return (
    <QueryClientProvider client={queryClient}>
      <BrowserRouter>{children}</BrowserRouter>
    </QueryClientProvider>
  );
};

export const AllRootProviders = (
  { children }: { children: ReactNode },
  config = { authContextValues: getBaseAuthContextValues },
) => {
  const baseProvider = BaseProvider({ children });
  return AuthProvider(
    {
      children: baseProvider,
    },
    config,
  );
};

export const SettleBoxRoutesProviders: Providers<
  DepositProviderConfig & BoxProviderConfig & AuthProviderConfig
> = (
  { children }: { children: ReactNode },
  config = {
    depositContextValues: getBaseDepositContextValues,
    boxContextValues: getBaseBoxContextValues,
    authContextValues: getBaseAuthContextValues,
  },
) => {
  const rootProviders = AllRootProviders({ children }, config);
  return (
    <DepositContext.Provider value={config.depositContextValues()}>
      <BoxContext.Provider value={config.boxContextValues()}>
        {rootProviders}
      </BoxContext.Provider>
    </DepositContext.Provider>
  );
};

export const AuthProvider: Providers<AuthProviderConfig> = (
  { children },
  config = { authContextValues: getBaseAuthContextValues },
) => {
  return (
    <AuthContext.Provider value={config.authContextValues()}>
      {children}
    </AuthContext.Provider>
  );
};
