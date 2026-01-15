import { createContext, useCallback, useContext, useState } from 'react';
import { CountedBy, ICountedByContext, STORAGE_COUNTED_BY } from '@/utils';

export const CountedByContext = createContext<ICountedByContext | null>(null);
export const useCountedByContext = () => {
  const context = useContext(CountedByContext);
  if (!context) {
    throw new Error('useCountedByContext must be used within CountedByContext.Provider');
  }
  return context;
};

export const useCountedByContextValues = () => {
  const [countedBy, updateCountedBy] = useState<CountedBy | null>(() =>
    JSON.parse(localStorage.getItem(STORAGE_COUNTED_BY) || '{}'),
  );

  const setCountedBy = useCallback((countedBy: CountedBy | null) => {
    localStorage.setItem(STORAGE_COUNTED_BY, JSON.stringify(countedBy));
    updateCountedBy(countedBy);
  }, []);

  const clearCountedBy = useCallback(() => {
    localStorage.removeItem(STORAGE_COUNTED_BY);
    updateCountedBy(null);
  }, []);

  return {
    setCountedBy,
    clearCountedBy,
    countedBy,
  };
};
