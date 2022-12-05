import { RouteObject } from 'react-router-dom';
import { GiveBoxPage, SettleBoxPage } from '../../pages/boxes';
import { InnerLayout } from '../../components';

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
  element: (
    <InnerLayout
      links={[
        { url: '/boxes/give', label: 'Wydaj puszkę' },
        { url: '/boxes/settle', label: 'Rozlicz puszkę' },
        { url: '/boxes', label: 'Wszystkie puszki' },
        { url: '/boxes/unsettled', label: 'Lista puszek nie rozliczonych' },
      ]}
    />
  ),
  children: boxesSubroutes,
};
