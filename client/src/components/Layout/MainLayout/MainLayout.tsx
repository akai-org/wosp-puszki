import { Layout } from 'antd';
import { Sidebar } from '../Sidebar/Sidebar';
import { Outlet } from 'react-router-dom';

import s from './MainLayout.module.css';

export const MainLayout = () => {
  const isLoggedIn = true;

  return (
    <Layout>
      <Sidebar />
      <Layout.Content
        className={isLoggedIn ? s.layoutContentWide : s.layoutContentNarrow}
      >
        <Outlet />
      </Layout.Content>
    </Layout>
  );
};
