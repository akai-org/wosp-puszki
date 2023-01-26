import type { RouteObject } from 'react-router-dom';
import { adminRoute, boxesRoute, countedBoxesRoute } from './nestedRoutes';
import { LoginPage, HomePage, NotFoundPage } from '@/pages';
import { MainLayout } from '@/components';
import { DisplayPage } from '@pages/DisplayPage';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';

const rootRoutes: RouteObject[] = [
  {
    path: 'login',
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
  { path: '*', element: <NotFoundPage /> },
];

export const routes: RouteObject[] = [
  {
    index: true,
    element: <DisplayPage />,
  },
  {
    path: 'liczymy',
    element: <MainLayout />,
    children: [...rootRoutes, countedBoxesRoute, adminRoute, boxesRoute],
  },
];
