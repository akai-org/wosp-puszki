import { ReactElement, ReactNode } from 'react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { AuthContext } from '@/App';
import { BrowserRouter } from 'react-router-dom';
import { getBaseAuthContextValues } from './basicMockupValues';
import { CustomWrapperInput } from './types';

type Providers<ConfigType extends object> = (
  input: CustomWrapperInput,
  config?: ConfigType,
) => ReactElement;

export const AllProviders = (
  { children }: { children: ReactNode },
  config = { authContextValues: getBaseAuthContextValues },
) => {
  const queryClient = new QueryClient();

  return (
    <AuthContext.Provider value={config.authContextValues()}>
      <QueryClientProvider client={queryClient}>
        <BrowserRouter>{children}</BrowserRouter>
      </QueryClientProvider>
    </AuthContext.Provider>
  );
};

export function createCustomWrapper<ProvidersConfig extends object>(
  providers: Providers<ProvidersConfig>,
) {
  return function (providersConfig?: ProvidersConfig) {
    return (input: CustomWrapperInput) => providers(input, providersConfig);
  };
}

export const AllProvidersWrapper = createCustomWrapper(AllProviders);
