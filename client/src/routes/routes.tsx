import type { RouteObject } from 'react-router-dom';
import {
  settleProcessRoute,
  adminRoute,
  boxesRoute,
  countedBoxesRoute,
} from './nestedRoutes';
import { LoginPage, HomePage, NotFoundPage } from '@/pages';
import { MainLayout } from '@/components';
import { DisplayPage } from '@pages/DisplayPage';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';
import { LOGIN_ROUTE, NOT_FOUND_ROUTE, MAIN_ROUTE } from '@/utils';

const rootRoutes: RouteObject[] = [
  {
    path: LOGIN_ROUTE,
    element: (
      <ProtectedRoute redirectTo="/liczymy" reversed>
        <LoginPage />
      </ProtectedRoute>
    ),
  },
  {
    index: true,
    element: (
      <ProtectedRoute>
        <HomePage />
      </ProtectedRoute>
    ),
  },
  { path: NOT_FOUND_ROUTE, element: <NotFoundPage /> },
];

export const routes: RouteObject[] = [
  {
    index: true,
    element: <DisplayPage />,
  },
  {
    path: MAIN_ROUTE,
    element: <MainLayout />,
    children: [
      ...rootRoutes,
      countedBoxesRoute,
      adminRoute,
      boxesRoute,
      settleProcessRoute,
    ],
  },
];
