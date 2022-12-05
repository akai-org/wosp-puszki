import { RouteObject } from 'react-router-dom';
import {
  AddUserPage,
  AddVolunteerPage,
  ListUsersPage,
  ListVolunteersPage,
  LogsPage,
} from '../../pages/admin';
import { InnerLayout } from '../../components';

const adminSubroutes: RouteObject[] = [
  {
    path: 'users/add',
    element: <AddUserPage />,
  },
  {
    index: true,
    element: <ListUsersPage />,
  },
  {
    path: 'volunteers/list',
    element: <ListVolunteersPage />,
  },
  {
    path: 'volunteers/add',
    element: <AddVolunteerPage />,
  },
  {
    path: 'logs',
    element: <LogsPage />,
  },
];

export const adminRoute = {
  path: 'admin',
  element: (
    <InnerLayout
      links={[
        { url: 'users/add', label: 'Dodaj użytkownika' },
        { url: '/admin', label: 'Lista użytkowników', withDot: true },
        { url: 'volunteers/add', label: 'Dodaj wolontariusza' },
        { url: 'volunteers/list', label: 'Lista użytkowników', withDot: true },
        { url: 'logs', label: 'Logi' },
      ]}
    />
  ),
  children: adminSubroutes,
};
