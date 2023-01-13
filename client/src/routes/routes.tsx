import type { RouteObject } from 'react-router-dom';
import { adminRoute, boxesRoute, countedBoxesRoute } from './nestedRoutes';
import { LoginPage, HomePage, NotFoundPage } from '@/pages';
import { MainLayout } from '@/components';
import { DisplayPage } from '@pages/DisplayPage';

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
  {
    path: '/display',
    element: <DisplayPage />,
  },
];

export const routes: RouteObject[] = [
  {
    path: '/',
    element: <MainLayout />,
    children: [...rootRoutes, countedBoxesRoute, adminRoute, boxesRoute],
  },
];
