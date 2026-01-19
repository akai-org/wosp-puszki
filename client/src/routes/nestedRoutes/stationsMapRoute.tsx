import type { RouteObject } from 'react-router-dom';
import { StationsPage } from '@pages/StationsPage';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';

export const stationsMapRoute: RouteObject = {
  path: 'stations',
  element: (
    <ProtectedRoute permission="movementcontroller">
      <StationsPage />
    </ProtectedRoute>
  ),
};
