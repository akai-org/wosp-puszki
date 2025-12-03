import { Layout } from 'antd';
import { Outlet } from 'react-router-dom';
import { useState, useEffect } from 'react';
import s from './MainLayout.module.less';
import { Sidebar } from '@components/Layout/Sidebar/Sidebar';
// import { NotificationCenter } from '@components/NotificationCenter';
import { getSidebarLinks, useAuthContext, useSidebarStateContext } from '@/utils';

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

  const { show, toggleSidebar } = useSidebarStateContext();

  const links = getSidebarLinks(roles);

  // const getUserId = () => {
  //   if (!username) return undefined;
  //   const match = username.match(/\d+$/);
  //   return match ? parseInt(match[0]) : undefined;
  // };

  return (
    <Layout className={s.layout}>
      <Sidebar
        links={links}
        show={show}
        toggleSidebar={toggleSidebar}
        deleteCredentials={deleteCredentials}
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
