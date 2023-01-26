import { RouteObject } from 'react-router-dom';
import { BoxesApprovedPage, BoxesForApprovalPage } from '@/pages';
import { InnerLayout } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';

const boxesApprovedPagePath = 'approved';

const countedBoxesSubroutes: RouteObject[] = [
  {
    index: true,
    element: <BoxesForApprovalPage />,
  },
  {
    path: boxesApprovedPagePath,
    element: <BoxesApprovedPage />,
  },
];

export const countedBoxesRoute = {
  path: 'countedBoxes',
  element: (
    <ProtectedRoute>
      <InnerLayout
        links={[
          { url: '', label: 'Lista puszek do zatwierdzenia' },
          {
            url: boxesApprovedPagePath,
            label: 'Lista puszek zatwierdzonych',
          },
        ]}
      />
    </ProtectedRoute>
  ),
  children: countedBoxesSubroutes,
};
