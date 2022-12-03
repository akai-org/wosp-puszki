import { MainLayout } from '../components/Layout/MainLayout/MainLayout';
import { LoginPage } from '../pages';
import { HomePage } from '../pages/home/HomePage';
import { RouteObject } from 'react-router-dom';
import { adminRoute } from './nestedRoutes/adminRoute';
import { boxesRoute } from './nestedRoutes/boxesRoute';
import { countedBoxesRoute } from './nestedRoutes/countedBoxesRoute';

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
