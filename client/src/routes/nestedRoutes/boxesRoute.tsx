import { RouteObject } from 'react-router-dom';
import { GiveBoxPage } from '../../pages/boxes/GiveBoxPage/GiveBoxPage';
import { SettleBoxPage } from '../../pages/boxes/SettleBoxPage/SettleBoxPage';
import { InnerLayout } from '../../components/Layout/InnerLayout/InnerLayout';

const boxesSubroutes: RouteObject[] = [
  {
    path: '/boxes/give',
    element: <GiveBoxPage />,
  },
  {
    path: '/boxes/settle',
    element: <SettleBoxPage />,
  },
  {
    index: true,
    element: <SettleBoxPage />,
  },
  {
    path: '/boxes/unsettled',
    element: <SettleBoxPage />,
  },
];

export const boxesRoute = {
  path: 'boxes',
  element: <InnerLayout />,
  children: boxesSubroutes,
};
