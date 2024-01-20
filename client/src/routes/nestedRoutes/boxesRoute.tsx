import { RouteObject } from 'react-router-dom';
import { GiveBoxPage, UnsettledBoxesPage, ListBoxesPage } from '@/pages';
import { InnerLayoutManager } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';
import {
  BOXES_LIST_PAGE_ROUTE,
  BOXES_PATH,
  BOXES_ROUTE,
  SETTLE_PROCESS_PATH,
  UNSETTLED_BOXES_LIST_PAGE_ROUTE,
} from '@/utils';

const boxesSubroutes: RouteObject[] = [
  {
    index: true,
    element: <GiveBoxPage />,
  },
  {
    path: BOXES_LIST_PAGE_ROUTE,
    element: <ListBoxesPage />,
  },
  {
    path: UNSETTLED_BOXES_LIST_PAGE_ROUTE,
    element: <UnsettledBoxesPage />,
  },
];

export const boxesRoute = {
  path: BOXES_ROUTE,
  element: (
    <ProtectedRoute>
      <InnerLayoutManager
        prefix={BOXES_PATH}
        excludingLinks={[]}
        links={[
          { url: BOXES_PATH, label: 'Wydaj puszkę' },
          { url: SETTLE_PROCESS_PATH, label: 'Rozlicz puszkę' },
          { url: BOXES_LIST_PAGE_ROUTE, label: 'Wszystkie puszki' },
          {
            url: UNSETTLED_BOXES_LIST_PAGE_ROUTE,
            label: 'Lista puszek nie rozliczonych',
          },
        ]}
      />
    </ProtectedRoute>
  ),
  children: boxesSubroutes,
};
