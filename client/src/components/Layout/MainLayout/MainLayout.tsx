import { Layout } from 'antd';
import { Outlet } from 'react-router-dom';
import s from './MainLayout.module.css';
import { Sidebar } from '@components/Layout/Sidebar/Sidebar';

export const MainLayout = () => {
  const isLoggedIn = false;

  return (
    <Layout>
      <Sidebar isLoggedIn={isLoggedIn} />
      <Layout.Content
        className={isLoggedIn ? s.layoutContentWide : s.layoutContentNarrow}
      >
        <Outlet />
      </Layout.Content>
    </Layout>
  );
};
