import { vi } from 'vitest';
import {
  UseAuthContextValues,
  UseBoxContextValues,
  UseDepositContextValues,
} from './types';

export const baseAuthContextValues = {
  credentials: 'superpassword',
  deleteCredentials: vi.fn(),
  createCredentials: vi.fn(),
  username: 'superadmin',
};
export const baseBoxContextValues = {
  createBox: vi.fn(),
  deleteBox: vi.fn(),
  collectorName: 'wosp01',
  collectorIdentifier: '20',
  boxIdentifier: '302',
};

export const baseDepositContextValues = {
  handleAmountsChange: vi.fn(),
  boxData: {
    comment: '',
    amounts: {
      count_1gr: 0,
      count_2gr: 0,
      count_5gr: 0,
      count_10gr: 0,
      count_20gr: 0,
      count_50gr: 0,
      count_1zl: 0,
      count_2zl: 0,
      count_5zl: 0,
      count_10zl: 0,
      count_20zl: 0,
      count_50zl: 0,
      count_100zl: 0,
      count_200zl: 0,
      count_500zl: 0,
      amount_EUR: 0,
      amount_USD: 0,
      amount_GBP: 0,
    },
  },
};

export const getBaseAuthContextValues: UseAuthContextValues = () => baseAuthContextValues;
export const getBaseBoxContextValues: UseBoxContextValues = () => baseBoxContextValues;
export const getBaseDepositContextValues: UseDepositContextValues = () =>
  baseDepositContextValues;
