import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import { routes } from './routes';
import { Spin } from 'antd';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { ReactQueryDevtools } from '@tanstack/react-query-devtools';
import '@assets/fonts/Oswald-Bold.ttf';
import { useEffect } from 'react';

const router = createBrowserRouter(routes);

export const queryClient = new QueryClient();

function App() {
  //383
  useEffect(() => {
    // próbowałem też z decodeURI i decodeURIComponent - żadnej różnicy nie ma
    const encoded = window.btoa('superadmin:zaq12wsx');
    console.log(encoded);

    fetch('http://localhost:8000/api/collectors/383/boxes/latestUncounted', {
      headers: { Authorization: `Basic ${encoded}` },
    })
      .then((data) => console.log(data))
      .catch((error) => console.log(error));
  }, []);

  return (
    <QueryClientProvider client={queryClient}>
      <RouterProvider router={router} fallbackElement={<Spin />} />
      <ReactQueryDevtools position="bottom-right" initialIsOpen={false} />
    </QueryClientProvider>
  );
}

export default App;
