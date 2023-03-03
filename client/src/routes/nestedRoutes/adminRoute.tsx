import { RouteObject } from 'react-router-dom';
import {
  AddUserPage,
  AddVolunteerPage,
  ListUsersPage,
  ListVolunteersPage,
  LogsPage,
} from '@/pages';
import { InnerLayout } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';
import {
  ADD_USER_PAGE_ROUTE,
  ADD_VOLUNTEER_PAGE_ROUTE,
  ADMIN_ROUTE,
  LOGS_PAGE_ROUTE,
  VOLUNTEERS_LIST_PAGE_ROUTE,
} from '@/utils';

const adminSubroutes: RouteObject[] = [
  {
    path: ADD_USER_PAGE_ROUTE,
    element: <AddUserPage />,
  },
  {
    index: true,
    element: <ListUsersPage />,
  },
  {
    path: VOLUNTEERS_LIST_PAGE_ROUTE,
    element: <ListVolunteersPage />,
  },
  {
    path: ADD_VOLUNTEER_PAGE_ROUTE,
    element: <AddVolunteerPage />,
  },
  {
    path: LOGS_PAGE_ROUTE,
    element: <LogsPage />,
  },
];

export const adminRoute = {
  path: ADMIN_ROUTE,
  element: (
    <ProtectedRoute>
      <InnerLayout
        links={[
          { url: ADD_USER_PAGE_ROUTE, label: 'Dodaj użytkownika' },
          { url: '', label: 'Lista użytkowników', withDot: true },
          { url: ADD_VOLUNTEER_PAGE_ROUTE, label: 'Dodaj wolontariusza' },
          {
            url: VOLUNTEERS_LIST_PAGE_ROUTE,
            label: 'Lista wolontariuszy',
            withDot: true,
          },
          { url: LOGS_PAGE_ROUTE, label: 'Logi' },
        ]}
      />
    </ProtectedRoute>
  ),
  children: adminSubroutes,
};
