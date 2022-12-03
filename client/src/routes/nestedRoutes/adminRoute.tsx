import { RouteObject } from 'react-router-dom';
import { AddUserPage } from '../../pages/admin/AddUserPage/AddUserPage';
import { ListUsersPage } from '../../pages/admin/ListUsersPage/ListUsersPage';
import { ListVolunteersPage } from '../../pages/admin/ListVolunteersPage/ListVolunteersPage';
import { AddVolunteerPage } from '../../pages/admin/AddVolunteerPage/AddVolunteerPage';
import { LogsPage } from '../../pages/admin/LogsPage/LogsPage';

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
  children: adminSubroutes,
};
