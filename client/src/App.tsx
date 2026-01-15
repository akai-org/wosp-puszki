import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import { routes } from './routes';
import { Spin } from 'antd';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { ReactQueryDevtools } from '@tanstack/react-query-devtools';
import '@assets/fonts/Oswald-Bold.ttf';
import {
  AuthContext,
  CountedByContext,
  SidebarStateContext,
  useAuthContextValues,
  useCountedByContextValues,
  useSidebarStateValues,
} from '@/utils';

const router = createBrowserRouter(routes, { basename: '/' });

export const queryClient = new QueryClient({
  defaultOptions: {
    mutations: { networkMode: 'always' },
    queries: { networkMode: 'always' },
  },
});

function App() {
  const authValues = useAuthContextValues();
  const sidebarValues = useSidebarStateValues();
  const countedByValues = useCountedByContextValues();

  return (
    <AuthContext.Provider value={authValues}>
      <CountedByContext.Provider value={countedByValues}>
        <SidebarStateContext.Provider value={sidebarValues}>
          <QueryClientProvider client={queryClient}>
            <RouterProvider router={router} fallbackElement={<Spin />} />
            <ReactQueryDevtools position="bottom-right" initialIsOpen={false} />
          </QueryClientProvider>
        </SidebarStateContext.Provider>
      </CountedByContext.Provider>
    </AuthContext.Provider>
  );
}

export default App;
