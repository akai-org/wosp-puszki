import { RouteObject } from 'react-router-dom';
import { BoxesApprovedPage, BoxesForApprovalPage } from '@/pages';
import { InnerLayout } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';
import { APPROVED_BOXES_PAGE_ROUTE, COUNTED_BOXES_ROUTE } from '@/utils';
import { ShowBoxPage } from '@/pages/countedBoxes/ShowBoxPage/ShowBoxPage';
import { EditBoxPage } from '@/pages/countedBoxes/EditBoxPage/EditBoxPage';

const countedBoxesSubroutes: RouteObject[] = [
  {
    path: '',
    element: (
      <ProtectedRoute permission="collectorcoordinator">
        <BoxesForApprovalPage />
      </ProtectedRoute>
    ),
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
  {
    path: APPROVED_BOXES_PAGE_ROUTE,
    element: (
      <ProtectedRoute permission="collectorcoordinator">
        <BoxesApprovedPage />
      </ProtectedRoute>
    ),
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
    <ProtectedRoute permission="collectorcoordinator">
      <InnerLayout
        links={[
          {
            url: '',
            label: 'Lista puszek do zatwierdzenia',
            permission: 'collectorcoordinator',
          },
          {
            url: APPROVED_BOXES_PAGE_ROUTE,
            label: 'Lista puszek zatwierdzonych',
            permission: 'collectorcoordinator',
          },
        ]}
      />
    </ProtectedRoute>
  ),
  children: countedBoxesSubroutes,
};
