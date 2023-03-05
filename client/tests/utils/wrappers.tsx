import { CustomWrapperInput, Providers, Wrapper } from './types';
import { AllRootProvidersFactory, SettleBoxRoutesProvidersFactory } from './providers';
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
  wrapper: Wrapper<Config>,
) {
  return {
    ...render(ui, {
      wrapper,
    }),
  };
}
export function renderWithUser<Config extends object>(
  ui: ReactElement,
  wrapper: Wrapper<Config>,
) {
  return {
    user: userEvent.setup(),
    ...render(ui, {
      wrapper,
    }),
  };
}

export const AllRootProvidersWrapper = createCustomWrapper(AllRootProvidersFactory);
export const SettleBoxProvidersWrapper = createCustomWrapper(SettleBoxRoutesProvidersFactory);
