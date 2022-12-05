import { RouteObject } from 'react-router-dom';
import { BoxesApprovedPage, BoxesForApprovalPage } from '../../pages/countedBoxes';
import { InnerLayout } from '../../components';

const countedBoxesSubroutes: RouteObject[] = [
  {
    index: true,
    element: <BoxesForApprovalPage />,
  },
  {
    path: 'approved',
    element: <BoxesApprovedPage />,
  },
];
export const countedBoxesRoute = {
  path: 'countedBoxes',
  element: (
    <InnerLayout
      links={[
        { url: '/countedBoxes', label: 'Lista puszek do zatwierdzenia' },
        {
          url: 'approved',
          label: 'Lista puszek zatwierdzonych',
        },
      ]}
    />
  ),
  children: countedBoxesSubroutes,
};
