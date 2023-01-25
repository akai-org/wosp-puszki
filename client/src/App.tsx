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

  const createCredentials = async (username: string, password: string) => {
    const encodedCredentials = window.btoa(decodeURI(`${username}:${password}`));
    await fetcher('http://localhost:8000/api/health', {
      headers: { Authorization: `Basic ${encodedCredentials}` },
    });
    localStorage.setItem('credentials', encodedCredentials);
    updateCredentials(encodedCredentials);
  };

  const deleteCredentials = () => {
    localStorage.removeItem('credentials');
    updateCredentials(null);
  };

  // useEffect(() => {
  //   fetch('http://localhost:8000/api/health', {
  //     headers: { Authorization: `Basic ${window.btoa('superadmin:zaq12wsx')}` },
  //   })
  //     .then((data) => data.json().then((ctn) => console.log(ctn)))
  //     .catch((err) => console.log(err));
  // }, []);

  return (
    <AuthContext.Provider value={{ credentials, createCredentials, deleteCredentials }}>
      <QueryClientProvider client={queryClient}>
        <RouterProvider router={router} fallbackElement={<Spin />} />
        <ReactQueryDevtools position="bottom-right" initialIsOpen={false} />
      </QueryClientProvider>
    </AuthContext.Provider>
  );
}

export default App;
