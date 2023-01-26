import { useContext, useState } from 'react';
import { AuthContext } from '@/App';
import { STORAGE_CREDENTIALS, STORAGE_USERNAME } from '@utils/storageKeys';
import { fetcher } from '@utils/fetcher';
import { APIManager } from '@utils/APIManager';

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

  const createCredentials = async (username: string, password: string) => {
    const encodedCredentials = window.btoa(decodeURI(`${username}:${password}`));
    await fetcher(APIManager.validateUserURL, {
      headers: { Authorization: `Basic ${encodedCredentials}` },
    });
    localStorage.setItem(STORAGE_CREDENTIALS, encodedCredentials);
    localStorage.setItem(STORAGE_USERNAME, username);
    updateCredentials(encodedCredentials);
    updateUsername(username);
  };

  const deleteCredentials = () => {
    localStorage.removeItem(STORAGE_CREDENTIALS);
    localStorage.removeItem(STORAGE_USERNAME);
    updateCredentials(null);
    updateUsername(null);
  };

  return { credentials, username, createCredentials, deleteCredentials };
};
