import { ReactElement, ReactNode } from 'react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { useAuthContextValues } from '@/utils';
import { vi } from 'vitest';
import { AuthContext } from '@/App';
import { BrowserRouter } from 'react-router-dom';

type CustomWrapperInput = {
  children: ReactNode;
};

const baseAuthContextValues: typeof useAuthContextValues = () => ({
  credentials: 'superpassword',
  deleteCredentials: vi.fn(),
  createCredentials: vi.fn(),
  username: 'superadmin',
});

type UseAuthContextValues = typeof useAuthContextValues;

type AuthProviderConfig = { authContextValues: UseAuthContextValues };

type Providers<ConfigType extends object> = (
  input: CustomWrapperInput,
  config?: ConfigType,
) => ReactElement;

export const AllProviders: Providers<AuthProviderConfig> = (
  { children },
  config = { authContextValues: baseAuthContextValues },
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
