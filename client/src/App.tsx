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

const router = createBrowserRouter([
  {
    path: '/login',
    element: <LoginPage />,
  },
  {
    path: '/home',
    element: <HomePage />,
  },
  {
    path: '/countedBoxes/forApproval',
    element: <BoxesForApprovalPage />,
  },
  {
    path: '/countedBoxes/approved',
    element: <BoxesApprovedPage />,
  },
  {
    path: '/admin/users/add',
    element: <AddUserPage />,
  },
  {
    path: '/admin/users/list',
    element: <ListUsersPage />,
  },
  {
    path: '/admin/volunteers/list',
    element: <ListVolunteersPage />,
  },
  {
    path: '/admin/volunteers/add',
    element: <AddVolunteerPage />,
  },
  {
    path: '/admin/logs',
    element: <LogsPage />,
  },
  {
    path: '/boxes/give',
    element: <GiveBoxPage />,
  },
  {
    path: '/boxes/settle',
    element: <SettleBoxPage />,
  },
  {
    path: '/boxes/all',
    element: <SettleBoxPage />,
  },
  {
    path: '/boxes/unsettled',
    element: <SettleBoxPage />,
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
