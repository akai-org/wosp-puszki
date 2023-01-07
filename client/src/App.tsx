import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import { routes } from './routes';
import { Spin } from 'antd';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { ReactQueryDevtools } from '@tanstack/react-query-devtools';
import { useEffect } from 'react';
import axios from 'axios';

const router = createBrowserRouter(routes);

export const queryClient = new QueryClient();

function App() {
  useEffect(() => {
    fetch('https://wosp.ang3r.pl/sanctum/csrf-cookie', { credentials: 'include' })
      .then((data) => {
        console.log(data.headers);
      })
      .catch((e) => console.log(e));

      // axios.get('https://wosp.ang3r.pl/sanctum/csrf-cookie', { withCredentials: true})
      //     .then((data) => {
      //         console.log(data.headers);
      //     })
      //     .catch((e) => console.log(e));
  }, []);

  return (
    <QueryClientProvider client={queryClient}>
      <RouterProvider router={router} fallbackElement={<Spin />} />;
      <ReactQueryDevtools position="bottom-right" initialIsOpen={false} />
    </QueryClientProvider>
  );
}

export default App;
