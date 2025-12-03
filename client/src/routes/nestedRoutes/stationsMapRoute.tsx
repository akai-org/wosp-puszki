import type { RouteObject } from 'react-router-dom';
import { StationsMapPage } from '@/pages/MovementControllerPage';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';

export const stationsMapRoute: RouteObject = {
  path: 'stations-map',
  element: (
    <ProtectedRoute permission="movementcontroller">
      <StationsMapPage />
    </ProtectedRoute>
  ),
};
