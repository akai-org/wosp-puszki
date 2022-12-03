import type { RouteObject } from 'react-router-dom';
import { adminRoute, boxesRoute, countedBoxesRoute } from './nestedRoutes';
import { LoginPage, HomePage, NotFoundPage } from '../pages';
import { MainLayout } from '../components';

const rootRoutes: RouteObject[] = [
  {
    path: '/login',
    element: <LoginPage />,
  },
  {
    index: true,
    element: <HomePage />,
  },
  { path: '*', element: <NotFoundPage /> },
];

export const routes: RouteObject[] = [
  {
    path: '/',
    element: <MainLayout />,
    children: [...rootRoutes, countedBoxesRoute, adminRoute, boxesRoute],
  },
];
