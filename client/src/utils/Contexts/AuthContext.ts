import { useContext, useState, createContext, useCallback } from 'react';
import {
  STORAGE_CREDENTIALS,
  STORAGE_USERNAME,
  fetcher,
  IAuthContext,
  APIManager,
  IAuthResponse,
  UserRole,
  STORAGE_USER_ROLES,
} from '@/utils';
import { isUserRole } from '../typeGuards';

export const AuthContext = createContext<IAuthContext | null>(null);

export const useAuthContext = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuthContext must be used within AuthContext.Provider');
  }
  return context;
};

export const useAuthContextValues = () => {
  const [credentials, updateCredentials] = useState<string | null>(() =>
    localStorage.getItem(STORAGE_CREDENTIALS),
  );
  const [username, updateUsername] = useState<string | null>(() =>
    localStorage.getItem(STORAGE_USERNAME),
  );
  const [roles, updateRoles] = useState<UserRole[]>(() =>
    JSON.parse(localStorage.getItem(STORAGE_USER_ROLES) || '[]'),
  );

  const createCredentials = useCallback(async (username: string, password: string) => {
    const encodedCredentials = window.btoa(decodeURI(`${username}:${password}`));
    const res = await fetcher<IAuthResponse>(APIManager.validateUserURL, {
      headers: { Authorization: `Basic ${encodedCredentials}` },
    });
    if (
      res.roles.map((role) => isUserRole(role)).includes(false) ||
      res.roles.length === 0
    ) {
      throw new Error('Nieprawidłowa rola użytkownika');
    }
    localStorage.setItem(STORAGE_CREDENTIALS, encodedCredentials);
    localStorage.setItem(STORAGE_USERNAME, username);
    localStorage.setItem(STORAGE_USER_ROLES, JSON.stringify(res.roles));
    updateCredentials(encodedCredentials);
    updateUsername(username);
    updateRoles(res.roles);
  }, []);

  const deleteCredentials = useCallback(() => {
    localStorage.removeItem(STORAGE_CREDENTIALS);
    localStorage.removeItem(STORAGE_USERNAME);
    localStorage.removeItem(STORAGE_USER_ROLES);
    updateCredentials(null);
    updateUsername(null);
    updateRoles([]);
  }, []);

  return { credentials, username, createCredentials, deleteCredentials, roles };
};
