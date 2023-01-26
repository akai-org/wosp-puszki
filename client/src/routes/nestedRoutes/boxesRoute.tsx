import { RouteObject } from 'react-router-dom';
import {
  GiveBoxPage,
  SettleBoxPage,
  UnsettledBoxesPage,
  ListBoxesPage,
  SettleBoxPageCheckout,
} from '@/pages';
import { InnerLayout } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';

const giveBoxPagePath = '/boxes/give';
const settleBoxPagePath = '/boxes/settle';
const settleBoxPagePathCheckout = '/boxes/settle/4';
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
    path: settleBoxPagePathCheckout,
    element: <SettleBoxPageCheckout />,
  },
  {
    index: true,
    element: <ListBoxesPage />,
  },
  {
    path: unsettledBoxesPagePath,
    element: <UnsettledBoxesPage />,
  },
];

export const boxesRoute = {
  path: 'boxes',
  element: (
    <ProtectedRoute>
      <InnerLayout
        links={[
          { url: giveBoxPagePath, label: 'Wydaj puszkę' },
          { url: settleBoxPagePath, label: 'Rozlicz puszkę' },
          { url: '', label: 'Wszystkie puszki' },
          { url: unsettledBoxesPagePath, label: 'Lista puszek nie rozliczonych' },
        ]}
      />
    </ProtectedRoute>
  ),
  children: boxesSubroutes,
};
