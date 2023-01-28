import { useState } from 'react';
import { createContext, ReactNode } from 'react';
export const DepositContext = createContext({});

interface ProviderProps {
  children: ReactNode;
}

export const DepositProvider: React.FC<ProviderProps> = ({ children }) => {
  const [data, setData] = useState({});
  console.log(Object.keys(data));

  return (
    <DepositContext.Provider value={{ data, setData }}>
      {children}
    </DepositContext.Provider>
  );
};
