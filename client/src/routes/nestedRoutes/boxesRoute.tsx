import { RouteObject } from 'react-router-dom';
import { GiveBoxPage, SettleBoxPage } from '../../pages/boxes';
import { InnerLayout } from '../../components';

const giveBoxPagePath = '/boxes/give';
const settleBoxPagePath = '/boxes/settle';
const allBoxesPagePath = '/boxes';
const unsettledBoxesPagePath = '/boxes/unsettled';

const boxesSubroutes: RouteObject[] = [
  {
    path: giveBoxPagePath,
    element: <GiveBoxPage />,
  },
  {
    path: settleBoxPagePath,
    element: <SettleBoxPage />,
  },
  {
    index: true,
    element: <SettleBoxPage />,
  },
  {
    path: unsettledBoxesPagePath,
    element: <SettleBoxPage />,
  },
];

export const boxesRoute = {
  path: 'boxes',
  element: (
    <InnerLayout
      links={[
        { url: giveBoxPagePath, label: 'Wydaj puszkę' },
        { url: settleBoxPagePath, label: 'Rozlicz puszkę' },
        { url: allBoxesPagePath, label: 'Wszystkie puszki' },
        { url: unsettledBoxesPagePath, label: 'Lista puszek nie rozliczonych' },
      ]}
    />
  ),
  children: boxesSubroutes,
};
