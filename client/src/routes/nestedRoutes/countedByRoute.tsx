import { COUNTED_BY_ROUTE } from '@/utils';
import { InnerLayout } from '@/components';
import { RouteObject } from 'react-router-dom';
import { CountedByPage } from '@pages/countedBy/CountedByPage';

const countedBySubroutes: RouteObject[] = [
  {
    path: '',
    element: <CountedByPage />,
  },
];

export const countedByRoute = {
  path: COUNTED_BY_ROUTE,
  element: <InnerLayout links={[]} />,
  children: countedBySubroutes,
};
