import { useContext, useState, createContext } from 'react';
import {
  IBoxContext,
  STORAGE_BOX_IDENTIFIER,
  STORAGE_COLLECTOR_IDENTIFIER,
  STORAGE_COLLECTOR_NAME,
  STORAGE_IS_BOX_SPECIAL,
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
  const [isBoxSpecial, updateIsBoxSpecial] = useState<boolean | null>(
    () => !!localStorage.getItem(STORAGE_IS_BOX_SPECIAL),
  );

  const createBox = async (
    collectorName: string,
    collectorIdentifier: string,
    boxIdentifier: string,
    isBoxSpecial: boolean,
  ) => {
    localStorage.setItem(STORAGE_COLLECTOR_NAME, collectorName);
    localStorage.setItem(STORAGE_COLLECTOR_IDENTIFIER, collectorIdentifier);
    localStorage.setItem(STORAGE_BOX_IDENTIFIER, boxIdentifier);
    localStorage.setItem(STORAGE_IS_BOX_SPECIAL, isBoxSpecial ? '1' : '');
    updateCollectorName(collectorName);
    updateCollectorIdentifier(collectorIdentifier);
    updateBoxIdentifier(boxIdentifier);
    updateIsBoxSpecial(isBoxSpecial);
  };

  const deleteBox = () => {
    localStorage.removeItem(STORAGE_COLLECTOR_NAME);
    localStorage.removeItem(STORAGE_COLLECTOR_IDENTIFIER);
    localStorage.removeItem(STORAGE_BOX_IDENTIFIER);
    localStorage.setItem(STORAGE_IS_BOX_SPECIAL, '');
    updateCollectorName(null);
    updateCollectorIdentifier(null);
    updateBoxIdentifier(null);
    updateIsBoxSpecial(null);
  };

  return {
    collectorName,
    collectorIdentifier,
    boxIdentifier,
    createBox,
    deleteBox,
    isBoxSpecial,
  };
};
