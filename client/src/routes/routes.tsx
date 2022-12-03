import type { RouteObject } from 'react-router-dom';
import { adminRoute, boxesRoute, countedBoxesRoute } from './nestedRoutes';
import { LoginPage } from '../pages';
import { HomePage } from '../pages/home';
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
];

export const routes: RouteObject[] = [
  {
    path: '/',
    element: <MainLayout />,
    children: [...rootRoutes, countedBoxesRoute, adminRoute, boxesRoute],
  },
];
