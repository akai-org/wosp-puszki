import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import { routes } from './routes';
import { Spin } from 'antd';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { ReactQueryDevtools } from '@tanstack/react-query-devtools';
import '@assets/fonts/Oswald-Bold.ttf';
import { ContextsProvider } from '@/utils';

const router = createBrowserRouter(routes, { basename: '/system' });

export const queryClient = new QueryClient();

function App() {
  return (
    <ContextsProvider>
      <QueryClientProvider client={queryClient}>
        <RouterProvider router={router} fallbackElement={<Spin />} />
        <ReactQueryDevtools position="bottom-right" initialIsOpen={false} />
      </QueryClientProvider>
    </ContextsProvider>
  );
}

export default App;
