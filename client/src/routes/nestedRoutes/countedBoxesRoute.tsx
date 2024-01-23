import { RouteObject } from 'react-router-dom';
import { BoxesForApprovalPage } from '@/pages';
import { InnerLayout } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';
import { COUNTED_BOXES_ROUTE } from '@/utils';
import { ShowBoxPage } from '@/pages/countedBoxes/ShowBoxPage/ShowBoxPage';
import { EditBoxPage } from '@/pages/countedBoxes/EditBoxPage/EditBoxPage';

const countedBoxesSubroutes: RouteObject[] = [
  {
    path: '',
    element: <BoxesForApprovalPage />,
    children: [
      {
        path: 'show/:id',
        element: <ShowBoxPage />,
      },
      {
        path: 'edit/:id',
        element: <EditBoxPage />,
      },
    ],
  },
];

export const countedBoxesRoute = {
  path: COUNTED_BOXES_ROUTE,
  element: (
    <ProtectedRoute adminOnly>
      <InnerLayout links={[{ url: '', label: 'Lista puszek do zatwierdzenia' }]} />
    </ProtectedRoute>
  ),
  children: countedBoxesSubroutes,
};
