import { ReactNode } from 'react';
import { useAuthContextValues } from '@/utils';

export type CustomWrapperInput = {
  children: ReactNode;
};

export type UseAuthContextValues = typeof useAuthContextValues;

export type AuthProviderConfig = { authContextValues: UseAuthContextValues };
