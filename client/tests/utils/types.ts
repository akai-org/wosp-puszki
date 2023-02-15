import { ReactElement, ReactNode } from 'react';
import { useAuthContextValues, useBoxContextValues } from '@/utils';
import { useDepositContext } from '@components/forms/DepositBoxForm/DepositContext';

export type CustomWrapperInput = {
  children: ReactNode;
};

export type UseAuthContextValues = typeof useAuthContextValues;

export type AuthProviderConfig = { authContextValues: UseAuthContextValues };
export type UseBoxContextValues = typeof useBoxContextValues;
export type BoxProviderConfig = { boxContextValues: UseBoxContextValues };

export type UseDepositContextValues = typeof useDepositContext;
export type DepositProviderConfig = {
  depositContextValues: UseDepositContextValues;
};

export type Providers<ConfigType extends object> = (
  input: CustomWrapperInput,
  config?: ConfigType,
) => ReactElement;
