import { useContext, useState, createContext } from 'react';
import { ISidebarStateContext } from '@/utils';

export const SidebarStateContext = createContext<ISidebarStateContext | null>(null);

export const useSidebarStateContext = () => {
  const context = useContext(SidebarStateContext);
  if (!context) {
    throw new Error('useBoxContext must be used within BoxContext.Provider');
  }
  return context;
};

export const useSidebarStateValues = () => {
  const [show, setShowState] = useState<boolean>(true);
  const toggleSidebar = () => setShowState(!show);

  return { show, toggleSidebar };
};
