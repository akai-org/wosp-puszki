import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import { routes } from './routes';
import { Spin } from 'antd';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { ReactQueryDevtools } from '@tanstack/react-query-devtools';
import '@assets/fonts/Oswald-Bold.ttf';
import { createContext, useState } from 'react';
import { fetcher, IAuthContext } from '@/utils';

const router = createBrowserRouter(routes);

export const queryClient = new QueryClient();

export const AuthContext = createContext<IAuthContext | null>(null);

function App() {
  const [credentials, updateCredentials] = useState<string | null>(() =>
    localStorage.getItem('credentials'),
  );
  const [username, updateUsername] = useState<string | null>(() =>
    localStorage.getItem('username'),
  );

  const createCredentials = async (username: string, password: string) => {
    const encodedCredentials = window.btoa(decodeURI(`${username}:${password}`));
    await fetcher('http://localhost:8000/api/health', {
      headers: { Authorization: `Basic ${encodedCredentials}` },
    });
    localStorage.setItem('credentials', encodedCredentials);
    localStorage.setItem('username', username);
    updateCredentials(encodedCredentials);
    updateUsername(username);
  };

  const deleteCredentials = () => {
    localStorage.removeItem('credentials');
    localStorage.removeItem('username');
    updateCredentials(null);
    updateUsername(null);
  };

  return (
    <AuthContext.Provider
      value={{ credentials, createCredentials, deleteCredentials, username }}
    >
      <QueryClientProvider client={queryClient}>
        <RouterProvider router={router} fallbackElement={<Spin />} />
        <ReactQueryDevtools position="bottom-right" initialIsOpen={false} />
      </QueryClientProvider>
    </AuthContext.Provider>
  );
}

export default App;
