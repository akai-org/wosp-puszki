import { Layout } from 'antd';
import { Outlet } from 'react-router-dom';
import s from './MainLayout.module.less';
import { Sidebar } from '@components/Layout/Sidebar/Sidebar';
import { useState } from 'react';
import { getSidebarLinks, useAuthContext, useSidebarStateContext } from '@/utils';

export const MainLayout = () => {
  // const isLoggedIn = true;
  const [isLoggedIn, setLoggedState] = useState(false);

  const { username, credentials, deleteCredentials } = useAuthContext();
  if (username !== null && !isLoggedIn) {
    setLoggedState(true);
  }

  const { show, toggleSidebar } = useSidebarStateContext();

  const links = getSidebarLinks(username);

  return (
    <Layout style={{ minHeight: '100vh' }}>
      <Sidebar
        username={username}
        links={links}
        credentials={credentials}
        show={show}
        toggleSidebar={toggleSidebar}
        deleteCredentials={deleteCredentials}
      />
      <Layout.Content
        className={[
          isLoggedIn ? s.layoutContentWide : s.layoutContentNarrow,
          !show ? s.narrow : null,
        ].join(' ')}
      >
        <Outlet />
      </Layout.Content>
    </Layout>
  );
};
