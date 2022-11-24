import './App.css';
import Sidebar from './components/Layout/Sidebar';
import './App.css';

import { createBrowserRouter, RouterProvider } from 'react-router-dom';

import { AddUserPage } from './pages/admin/AddUserPage';
import { AddVolunteerPage } from './pages/admin/AddVolunteerPage';
import { ListUsersPage } from './pages/admin/ListUsersPage';
import { ListVolunteersPage } from './pages/admin/ListVolunteersPage';
import { LogsPage } from './pages/admin/LogsPage';
import { GiveBoxPage } from './pages/boxes/GiveBoxPage';
import { SettleBoxPage } from './pages/boxes/SettleBoxPage';
import { BoxesApprovedPage } from './pages/countedBoxes/BoxesApprovedPage';
import { BoxesForApprovalPage } from './pages/countedBoxes/BoxesForApprovalPage';
import { HomePage } from './pages/Home';
import { LoginPage } from './pages/Login';

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
      <Sidebar />
      <RouterProvider router={router} />;
    </div>
  );
}

export default App;
