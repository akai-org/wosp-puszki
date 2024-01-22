import {
  AcceptDataPage,
  DepositBoxPage,
  FindBoxPage,
  SettleBoxPage,
  SettleBoxPageCheckout,
} from '@/pages';
import { RouteObject } from 'react-router-dom';
import {
  ACCEPT_BOX_PAGE_ROUTE,
  BOXES_PATH,
  CHECKOUT_BOX_PAGE_ROUTE,
  DEPOSIT_BOX_PAGE_ROUTE,
  FIND_BOX_PAGE_ROUTE,
  SETTLE_PROCESS_PATH,
  SettleProcessProvider,
} from '@/utils';
import { ProtectedRoute } from '@/components/ProtectedRoute/ProtectedRoute';
import { InnerLayoutManager } from '@/components';

const settleProcessSubroutes: RouteObject[] = [
  {
    index: true,
    element: <SettleBoxPage />,
  },
  {
    path: FIND_BOX_PAGE_ROUTE,
    element: <FindBoxPage />,
  },
  {
    path: ACCEPT_BOX_PAGE_ROUTE,
    element: <AcceptDataPage />,
  },
  {
    path: DEPOSIT_BOX_PAGE_ROUTE,
    element: <DepositBoxPage />,
  },
  {
    path: CHECKOUT_BOX_PAGE_ROUTE,
    element: <SettleBoxPageCheckout />,
  },
];

export const settleProcessRoute = {
  path: SETTLE_PROCESS_PATH,
  element: (
    <SettleProcessProvider>
      <ProtectedRoute>
        <InnerLayoutManager
          prefix={SETTLE_PROCESS_PATH}
          excludingLinks={[
            FIND_BOX_PAGE_ROUTE,
            ACCEPT_BOX_PAGE_ROUTE,
            DEPOSIT_BOX_PAGE_ROUTE,
            CHECKOUT_BOX_PAGE_ROUTE,
          ]}
          links={[
            {
              url: BOXES_PATH,
              label: 'Wydaj puszkę',
              permission: 'collectorcoordinator',
            },
            {
              url: SETTLE_PROCESS_PATH,
              label: 'Rozlicz puszkę',
              permission: 'volounteer',
            },
          ]}
        />
      </ProtectedRoute>
    </SettleProcessProvider>
  ),
  children: settleProcessSubroutes,
};
