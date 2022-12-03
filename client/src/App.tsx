import { createBrowserRouter, RouterProvider } from 'react-router-dom';

import { AddUserPage } from './pages/admin/AddUserPage/AddUserPage';
import { AddVolunteerPage } from './pages/admin/AddVolunteerPage/AddVolunteerPage';
import { ListUsersPage } from './pages/admin/ListUsersPage/ListUsersPage';
import { ListVolunteersPage } from './pages/admin/ListVolunteersPage/ListVolunteersPage';
import { LogsPage } from './pages/admin/LogsPage/LogsPage';
import { GiveBoxPage } from './pages/boxes/GiveBoxPage/GiveBoxPage';
import { SettleBoxPage } from './pages/boxes/SettleBoxPage/SettleBoxPage';
import { BoxesApprovedPage } from './pages/countedBoxes/BoxesApprovedPage/BoxesApprovedPage';
import { BoxesForApprovalPage } from './pages/countedBoxes/BoxesApprovedPage/BoxesForApprovalPage';
import { HomePage } from './pages/home/HomePage';
import { LoginPage } from './pages';
import { MainLayout } from './components/Layout/MainLayout/MainLayout';
import { InnerLayout } from './components/Layout/InnerLayout/InnerLayout';

const router = createBrowserRouter([
  {
    path: '/',
    element: <MainLayout />,
    children: [
      {
        path: 'countedBoxes',
        children: [
          {
            index: true,
            element: <BoxesForApprovalPage />,
          },
          {
            path: 'approved',
            element: <BoxesApprovedPage />,
          },
        ],
      },
      {
        path: 'admin',
        children: [
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
        ],
      },
      {
        path: 'boxes',
        element: <InnerLayout />,
        children: [
          {
            path: '/boxes/give',
            element: <GiveBoxPage />,
          },
          {
            path: '/boxes/settle',
            element: <SettleBoxPage />,
          },
          {
            index: true,
            element: <SettleBoxPage />,
          },
          {
            path: '/boxes/unsettled',
            element: <SettleBoxPage />,
          },
        ],
      },
      {
        path: '/login',
        element: <LoginPage />,
      },
      {
        index: true,
        element: <HomePage />,
      },
    ],
  },
]);

function App() {
  return (
    <div>
      <RouterProvider router={router} />
    </div>
  );
}

export default App;
