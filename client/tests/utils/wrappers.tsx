import { AuthProviderConfig, CustomWrapperInput, Providers } from './types';
import { AllRootProviders } from './providers';
import { ReactElement } from 'react';
import { render } from '@testing-library/react';

export function createCustomWrapper<ProvidersConfig extends object>(
  providers: Providers<ProvidersConfig>,
) {
  return function (providersConfig?: ProvidersConfig) {
    return (input: CustomWrapperInput) => providers(input, providersConfig);
  };
}

export const renderWithWrapper = (ui: ReactElement, config?: AuthProviderConfig) => {
  return {
    ...render(ui, {
      wrapper: AllRootProvidersWrapper(config),
    }),
  };
};

export const AllRootProvidersWrapper = createCustomWrapper(AllRootProviders);
