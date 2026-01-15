import { ReactElement, ReactNode } from 'react';
import {
  UseAuthContextValues,
  UseBoxContextValues,
  UseCountedByContextValues,
  UseDepositContextValues,
} from '@/utils';

export type CustomWrapperInput = {
  children: ReactNode;
};

export type AuthProviderConfig = { authContextValues: UseAuthContextValues };
export type BoxProviderConfig = { boxContextValues: UseBoxContextValues };
export type CountedByProviderConfig = {
  countedByContextValues: UseCountedByContextValues;
};
export type DepositProviderConfig = {
  depositContextValues: UseDepositContextValues;
};

export type Providers<ConfigType extends object> = (
  input: CustomWrapperInput,
  config?: ConfigType,
) => ReactElement;

export type Wrapper<ConfigType extends object> = Providers<ConfigType>;
