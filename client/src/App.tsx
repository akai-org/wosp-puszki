import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import { routes } from './routes';
import { Spin } from 'antd';

const router = createBrowserRouter(routes);

function App() {
  return <RouterProvider router={router} fallbackElement={<Spin />} />;
}

export default App;
