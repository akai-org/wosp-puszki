import { Layout } from 'antd';
import { Outlet } from 'react-router-dom';
import { useState, useEffect } from 'react';
import s from './MainLayout.module.less';
import { Sidebar } from '@components/Layout/Sidebar/Sidebar';
import {
  getSidebarLinks,
  useAuthContext,
  useCountedByContext,
  useSidebarStateContext,
} from '@/utils';

export const MainLayout = () => {
  const [isLoggedIn, setLoggedState] = useState(false);

  const { username, credentials, deleteCredentials, roles } = useAuthContext();
  useEffect(() => {
    if (username !== null) {
      setLoggedState(true);
    } else {
      setLoggedState(false);
    }
  }, [username]);
  
  const { clearCountedBy } = useCountedByContext();
  if (username !== null && !isLoggedIn) {
    setLoggedState(true);
  }

  const clearSession = () => {
    deleteCredentials();
    clearCountedBy();
  };

  const { show, toggleSidebar } = useSidebarStateContext();

  const links = getSidebarLinks(roles);

  return (
    <Layout className={s.layout}>
      <Sidebar
        links={links}
        show={show}
        toggleSidebar={toggleSidebar}
        deleteCredentials={clearSession}
        username={username}
        credentials={credentials}
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
