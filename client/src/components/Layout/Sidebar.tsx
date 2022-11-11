import { Button, Layout } from 'antd';
import React, { useState } from 'react';

import { pageName } from '../../types/Sidebar';
import styles from './Sidebar.module.css';

const { Header, Footer } = Layout;

const Sidebar: React.FC = () => {
  const userName = 'superadmin';
  const [page] = useState(window.location.hash) as unknown as pageName;

  return (
    <Layout className={`${styles.sidebar} ${styles['sidebar-layout']}`}>
      <Header className={`${styles.sidebar} ${styles['sidebar-header']}`}>
        <img src="/src/assets/wospLogo.png" alt="WOSP Logo" />
      </Header>
      <Layout className={`${styles.sidebar} ${styles['sidebar-content']}`}>
        <a
          className={`${styles.sidebar} ${styles[`${page === '#home' ? 'active' : ''}`]}`}
          href="#home"
        >
          Strona Główna
        </a>
        <a
          className={`${styles.sidebar} ${
            styles[`${page === '#count' ? 'active' : ''}`]
          }`}
          href="#count"
        >
          Przeliczone puszki
        </a>
        <a
          className={`${styles.sidebar} ${
            styles[`${page === '#admin' ? 'active' : ''}`]
          }`}
          href="#admin"
        >
          Administracja
        </a>
        <a
          className={`${styles.sidebar} ${styles[`${page === '#box' ? 'active' : ''}`]}`}
          href="#box"
        >
          Puszki
        </a>
      </Layout>
      <Footer className={`${styles.sidebar} ${styles['sidebar-footer']}`}>
        <p>Użytkownik:</p>
        <p className={styles['user-name']}>{userName}</p>
        <Button type="primary">Wyloguj</Button>
      </Footer>
    </Layout>
  );
};

export default Sidebar;
