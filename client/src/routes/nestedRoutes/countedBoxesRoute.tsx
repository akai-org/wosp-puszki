import { RouteObject } from 'react-router-dom';
import { BoxesApprovedPage, BoxesForApprovalPage } from '../../pages/countedBoxes';
import { InnerLayout } from '../../components';

const boxesForApprovalPagePath = '/countedBoxes';
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
    <InnerLayout
      links={[
        { url: boxesForApprovalPagePath, label: 'Lista puszek do zatwierdzenia' },
        {
          url: boxesApprovedPagePath,
          label: 'Lista puszek zatwierdzonych',
        },
      ]}
    />
  ),
  children: countedBoxesSubroutes,
};
