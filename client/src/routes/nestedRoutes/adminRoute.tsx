import { RouteObject } from 'react-router-dom';
import { AddUserPage, ListUsersPage, ListVolunteersPage, LogsPage } from '@/pages';
import { InnerLayout } from '@/components';
import { ProtectedRoute } from '@components/ProtectedRoute/ProtectedRoute';
import {
  ADD_USER_PAGE_ROUTE,
  ADMIN_ROUTE,
  LOGS_PAGE_ROUTE,
  VOLUNTEERS_LIST_PAGE_ROUTE,
} from '@/utils';

const adminSubroutes: RouteObject[] = [
  {
    path: ADD_USER_PAGE_ROUTE,
    element: (
      <ProtectedRoute permission="superadmin">
        <AddUserPage />
      </ProtectedRoute>
    ),
  },
  {
    index: true,
    element: (
      <ProtectedRoute permission="superadmin">
        <ListUsersPage />
      </ProtectedRoute>
    ),
  },
  {
    path: VOLUNTEERS_LIST_PAGE_ROUTE,
    element: (
      <ProtectedRoute permission="collectorcoordinator">
        <ListVolunteersPage />
      </ProtectedRoute>
    ),
  },
  {
    path: LOGS_PAGE_ROUTE,
    element: (
      <ProtectedRoute permission="collectorcoordinator">
        <LogsPage />
      </ProtectedRoute>
    ),
  },
];

export const adminRoute = {
  path: ADMIN_ROUTE,
  element: (
    <ProtectedRoute permission="collectorcoordinator">
      <InnerLayout
        links={[
          {
            url: ADD_USER_PAGE_ROUTE,
            label: 'Dodaj użytkownika',
            permission: 'superadmin',
          },
          {
            url: '',
            label: 'Lista użytkowników',
            withDot: true,
            permission: 'superadmin',
          },
          {
            url: VOLUNTEERS_LIST_PAGE_ROUTE,
            label: 'Lista wolontariuszy',
            withDot: true,
            permission: 'collectorcoordinator',
          },
          { url: LOGS_PAGE_ROUTE, label: 'Logi', permission: 'collectorcoordinator' },
        ]}
      />
    </ProtectedRoute>
  ),
  children: adminSubroutes,
};
