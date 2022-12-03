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
  element: <InnerLayout />,
  children: adminSubroutes,
};
