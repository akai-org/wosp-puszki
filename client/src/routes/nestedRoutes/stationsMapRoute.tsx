import type { RouteObject } from 'react-router-dom';
import { StationsMapPage } from '@/pages/MovementControllerPage';

export const stationsMapRoute: RouteObject = {
  path: 'stations-map',
  element: <StationsMapPage />,
};

