import { CustomWrapperInput, Providers } from './types';
import { AllRootProviders, SettleBoxRoutesProviders } from './providers';
import { ReactElement } from 'react';
import { render } from '@testing-library/react';
import userEvent from '@testing-library/user-event';

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
export function renderWithUser<Config extends object>(
  ui: ReactElement,
  provider: Providers<Config>,
) {
  return {
    user: userEvent.setup(),
    ...render(ui, {
      wrapper: provider,
    }),
  };
}

export const AllRootProvidersWrapper = createCustomWrapper(AllRootProviders);
export const SettleBoxProvidersWrapper = createCustomWrapper(SettleBoxRoutesProviders);
