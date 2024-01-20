import { createContext, useContext, useEffect, useState } from 'react';
import { DisplayableData, ICountedBoxesContext } from '../types';

export const CountedBoxesContext = createContext<ICountedBoxesContext | null>(null);

export const useCountedBoxesContext = () => {
  const context = useContext(CountedBoxesContext);
  if (!context) {
    throw new Error('useCountedBoxesContext must be used within AuthContext.Provider');
  }
  return context;
};

export const useCountedBoxesContextValues = (
  verifiedBoxes: DisplayableData[],
  unverifiedBoxes: DisplayableData[],
) => {
  const [storedUnverifiedData, setStoredUnverifiedData] =
    useState<DisplayableData[]>(unverifiedBoxes);
  const [storedVerifiedData, setStoredVerifiedData] =
    useState<DisplayableData[]>(verifiedBoxes);

  useEffect(() => {
    setStoredVerifiedData(verifiedBoxes);
  }, [unverifiedBoxes]);

  useEffect(() => {
    setStoredUnverifiedData(unverifiedBoxes);
  }, [unverifiedBoxes]);

  return { storedUnverifiedData, storedVerifiedData };
};
