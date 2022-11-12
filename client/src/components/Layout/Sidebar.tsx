import { Button, Layout } from 'antd';
import React, { Fragment } from 'react';

import styles from './Sidebar.module.css';
import SidebarItem from './SidebarItem';

const { Header, Footer } = Layout;

const bookmarks = [
  { name: 'Strona Główna', url: '#home' },
  { name: 'Przeliczone puszki', url: '#count' },
  { name: 'Administracja', url: '#admin' },
  { name: 'Puszki', url: '#box' },
];

const Sidebar: React.FC = (props) => {
  const userName = 'superadmin';
  const isLogin = true;

  return (
    <Fragment>
      {!isLogin ? (
        <Layout
          className={[styles.sidebar, styles.sidebarLayout, styles.sidebarLoginPage].join(
            ' ',
          )}
        >
          <Header className={[styles.sidebar, styles.sidebarHeader].join(' ')}>
            <img src="/src/assets/wospLogo.png" alt="WOSP Logo" />
          </Header>
        </Layout>
      ) : (
        <Layout className={[styles.sidebar, styles.sidebarLayout].join(' ')}>
          <Header className={[styles.sidebar, styles.sidebarHeader].join(' ')}>
            <img src="/src/assets/wospLogo.png" alt="WOSP Logo" />
          </Header>
          <Layout className={[styles.sidebar, styles.sidebarContent].join(' ')}>
            {bookmarks.map((item) => (
              <SidebarItem name={item.name} url={item.url} key={item.name} />
            ))}
          </Layout>
          <Footer className={[styles.sidebar, styles.sidebarFooter].join(' ')}>
            <p>Użytkownik:</p>
            <p className={styles.userName}>{userName}</p>
            <Button type="primary">Wyloguj</Button>
          </Footer>
        </Layout>
      )}
    </Fragment>
  );
};

export default Sidebar;
