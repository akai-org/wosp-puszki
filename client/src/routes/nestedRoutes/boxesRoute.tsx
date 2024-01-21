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
  useAuthContext,
} from '@/utils';
import { ShowBoxPage } from '@/pages/countedBoxes/ShowBoxPage/ShowBoxPage';

const boxesSubroutes: RouteObject[] = [
  {
    index: true,
    element: <GiveBoxPage />,
  },
  {
    path: BOXES_LIST_PAGE_ROUTE,
    element: <ListBoxesPage />,
    children: [{ path: 'show/:id', element: <ShowBoxPage displayOnly /> }],
  },
  {
    path: UNSETTLED_BOXES_LIST_PAGE_ROUTE,
    element: <UnsettledBoxesPage />,
    children: [{ path: 'show/:id', element: <ShowBoxPage displayOnly /> }],
  },
];

const BoxesRoute = () => {
  const { username } = useAuthContext();
  const lastTwoCharacters = username?.slice(-2);
  const isAdmin = isNaN(parseInt(lastTwoCharacters as string));
  const links = [
    { url: BOXES_PATH, label: 'Wydaj puszkę' },
    { url: SETTLE_PROCESS_PATH, label: 'Rozlicz puszkę' },
  ];
  if (isAdmin) {
    links.push({ url: BOXES_LIST_PAGE_ROUTE, label: 'Wszystkie puszki' });
    links.push({
      url: UNSETTLED_BOXES_LIST_PAGE_ROUTE,
      label: 'Lista puszek nie rozliczonych',
    });
  }
  return (
    <ProtectedRoute>
      <InnerLayoutManager prefix={BOXES_PATH} excludingLinks={[]} links={links} />
    </ProtectedRoute>
  );
};

export const boxesRoute = {
  path: BOXES_ROUTE,
  element: <BoxesRoute />,
  children: boxesSubroutes,
};
