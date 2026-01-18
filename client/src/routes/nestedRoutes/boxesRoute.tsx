import { RouteObject } from 'react-router-dom';
import { GiveBoxPage, ListBoxesPage, UnsettledBoxesPage } from '@/pages';
import { InnerLayoutManager } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';
import {
  BOXES_LIST_PAGE_ROUTE,
  BOXES_PATH,
  BOXES_ROUTE,
  SETTLE_PROCESS_PATH,
  UNSETTLED_BOXES_LIST_PAGE_ROUTE,
} from '@/utils';
import { ShowBoxPage } from '@/pages/countedBoxes/ShowBoxPage/ShowBoxPage';

const boxesSubroutes: RouteObject[] = [
  {
    index: true,
    element: <GiveBoxPage />,
  },
  {
    path: BOXES_LIST_PAGE_ROUTE,
    element: (
      <ProtectedRoute>
        <ListBoxesPage />
      </ProtectedRoute>
    ),
    children: [{ path: 'show/:id', element: <ShowBoxPage displayOnly /> }],
  },
  {
    path: UNSETTLED_BOXES_LIST_PAGE_ROUTE,
    element: (
      <ProtectedRoute>
        <UnsettledBoxesPage />
      </ProtectedRoute>
    ),
    children: [{ path: 'show/:id', element: <ShowBoxPage displayOnly /> }],
  },
];

export const boxesRoute = {
  path: BOXES_ROUTE,
  element: (
    <ProtectedRoute>
      <InnerLayoutManager
        prefix={BOXES_PATH}
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
          {
            url: BOXES_LIST_PAGE_ROUTE,
            label: 'Wszystkie puszki',
            permission: 'collectorcoordinator',
          },
          {
            url: UNSETTLED_BOXES_LIST_PAGE_ROUTE,
            label: 'Lista puszek nierozliczonych',
            permission: 'collectorcoordinator',
          },
        ]}
      />
    </ProtectedRoute>
  ),
  children: boxesSubroutes,
};
