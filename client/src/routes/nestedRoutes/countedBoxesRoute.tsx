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
  element: <InnerLayout />,
  children: countedBoxesSubroutes,
};
