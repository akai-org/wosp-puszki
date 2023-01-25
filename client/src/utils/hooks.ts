import { useContext } from 'react';
import { AuthContext } from '@/App';

export const useAuthContext = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('useAuthContext must be used within AuthContext.Provider');
  }
  return context;
};
