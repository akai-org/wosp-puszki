import { CustomWrapperInput, Providers } from './types';
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

export function renderWithWrapper<Config extends object>(
  ui: ReactElement,
  provider: Providers<Config>,
) {
  return {
    ...render(ui, {
      wrapper: provider,
    }),
  };
}

export const AllRootProvidersWrapper = createCustomWrapper(AllRootProviders);
