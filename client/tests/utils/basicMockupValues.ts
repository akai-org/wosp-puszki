import { useAuthContextValues } from '@/utils';
import { vi } from 'vitest';

export const baseAuthContextValues = {
  credentials: 'superpassword',
  deleteCredentials: vi.fn(),
  createCredentials: vi.fn(),
  username: 'superadmin',
};

export const getBaseAuthContextValues: typeof useAuthContextValues = () =>
  baseAuthContextValues;
