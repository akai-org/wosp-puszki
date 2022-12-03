import { RouteObject } from 'react-router-dom';
import { BoxesForApprovalPage } from '../../pages/countedBoxes/BoxesApprovedPage/BoxesForApprovalPage';
import { BoxesApprovedPage } from '../../pages/countedBoxes/BoxesApprovedPage/BoxesApprovedPage';

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
  children: countedBoxesSubroutes,
};
