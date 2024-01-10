import { RouteObject } from 'react-router-dom';
import { BoxesApprovedPage, BoxesForApprovalPage } from '@/pages';
import { InnerLayout } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';
import { APPROVED_BOXES_PAGE_ROUTE, COUNTED_BOXES_ROUTE } from '@/utils';
import { ShowBoxPage } from '@/pages/countedBoxes/ShowBoxPage/ShowBoxPage';
import { EditBoxPage } from '@/pages/countedBoxes/EditBoxPage/EditBoxPage';

const countedBoxesSubroutes: RouteObject[] = [
  {
    index: true,
    element: <BoxesForApprovalPage />,
  },
  {
    path: 'show/:id',
    element: <ShowBoxPage />
  },
  {
    path: 'edit/:id',
    element: <EditBoxPage />
  },
  {
    path: APPROVED_BOXES_PAGE_ROUTE,
    element: <BoxesApprovedPage />,
    children: [
      {
        path: 'show/:id',
        element: <ShowBoxPage />
      },
      {
        path: 'edit/:id',
        element: <EditBoxPage />
      }
    ]
  },
];

export const countedBoxesRoute = {
  path: COUNTED_BOXES_ROUTE,
  element: (
    <ProtectedRoute>
      <InnerLayout
        links={[
          { url: '', label: 'Lista puszek do zatwierdzenia' },
          {
            url: APPROVED_BOXES_PAGE_ROUTE,
            label: 'Lista puszek zatwierdzonych',
          },
        ]}
      />
    </ProtectedRoute>
  ),
  children: countedBoxesSubroutes,
};
