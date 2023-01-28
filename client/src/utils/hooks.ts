import { useContext, useState } from 'react';
import { AuthContext, BoxContext } from '@/App';
import {
  STORAGE_CREDENTIALS,
  STORAGE_USERNAME,
  STORAGE_BOX_IDENTIFIER,
  STORAGE_COLLECTOR_IDENTIFIER,
  STORAGE_COLLECTOR_NAME,
} from '@utils/storageKeys';
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

export const useBoxContext = () => {
  const context = useContext(BoxContext);
  if (!context) {
    throw new Error('useBoxContext must be used within BoxContext.Provider');
  }
  return context;
};

export const useBoxContextValues = () => {
  const [collectorName, updateCollectorName] = useState<string | null>(() =>
    localStorage.getItem(STORAGE_COLLECTOR_NAME),
  );
  const [collectorIdentifier, updateCollectorIdentifier] = useState<string | null>(() =>
    localStorage.getItem(STORAGE_COLLECTOR_IDENTIFIER),
  );
  const [boxIdentifier, updateBoxIdentifier] = useState<string | null>(() =>
    localStorage.getItem(STORAGE_BOX_IDENTIFIER),
  );

  const createBox = async (
    collectorName: string,
    collectorIdentifier: string,
    boxIdentifier: string,
  ) => {
    localStorage.setItem(STORAGE_COLLECTOR_NAME, collectorName);
    localStorage.setItem(STORAGE_COLLECTOR_IDENTIFIER, collectorIdentifier);
    localStorage.setItem(STORAGE_BOX_IDENTIFIER, boxIdentifier);
    updateCollectorName(collectorName);
    updateCollectorIdentifier(collectorIdentifier);
    updateBoxIdentifier(boxIdentifier);
  };

  const deleteBox = () => {
    localStorage.removeItem(STORAGE_COLLECTOR_NAME);
    localStorage.removeItem(STORAGE_COLLECTOR_IDENTIFIER);
    localStorage.removeItem(STORAGE_BOX_IDENTIFIER);
    updateCollectorName(null);
    updateCollectorIdentifier(null);
    updateBoxIdentifier(null);
  };

  return {
    collectorName,
    collectorIdentifier,
    boxIdentifier,
    createBox,
    deleteBox,
  };
};
