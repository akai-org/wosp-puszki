import { RouteObject } from 'react-router-dom';
import {
  GiveBoxPage,
  FindBoxPage,
  AcceptDataPage,
  SettleBoxPage,
  UnsettledBoxesPage,
  ListBoxesPage,
  SettleBoxPageCheckout,
} from '@/pages';
import { InnerLayoutManager } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';

import { DepositBoxForm } from '@/components/forms/DepositBoxForm';
import { DepositProvider } from '@/components/forms/DepositBoxForm/DepositContext';

const giveBoxPagePath = 'give';
const settleBoxPagePath = 'settle';
const findBoxPagePath = 'settle/1';
const acceptBoxPagePath = 'settle/2';
const depositBoxPagePath = 'settle/3';
const settleBoxPagePathCheckout = 'settle/4';
const unsettledBoxesPagePath = 'unsettled';

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
    path: findBoxPagePath,
    element: <FindBoxPage />,
  },
  {
    path: acceptBoxPagePath,
    element: <AcceptDataPage />,
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
  {
    path: depositBoxPagePath,
    element: <DepositBoxForm />,
  },
];

export const boxesRoute = {
  path: 'boxes',
  element: (
    <ProtectedRoute>
      <DepositProvider>
        <InnerLayoutManager
          prefix="/liczymy/boxes"
          excludingLinks={[
            findBoxPagePath,
            acceptBoxPagePath,
            depositBoxPagePath,
            settleBoxPagePathCheckout,
          ]}
          links={[
            { url: giveBoxPagePath, label: 'Wydaj puszkę' },
            { url: settleBoxPagePath, label: 'Rozlicz puszkę' },
            { url: '', label: 'Wszystkie puszki' },
            { url: unsettledBoxesPagePath, label: 'Lista puszek nie rozliczonych' },
          ]}
        />
      </DepositProvider>
    </ProtectedRoute>
  ),
  children: boxesSubroutes,
};
