import { useContext, useState, createContext } from 'react';
import {
  IBoxContext,
  STORAGE_BOX_IDENTIFIER,
  STORAGE_COLLECTOR_IDENTIFIER,
  STORAGE_COLLECTOR_NAME,
} from '@/utils';

export const BoxContext = createContext<IBoxContext | null>(null);

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
