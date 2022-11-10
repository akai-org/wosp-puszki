import { Layout, Button } from 'antd';
import React from 'react';
import styles from './Sidebar.module.css';

const { Header, Footer } = Layout;

const Sidebar: React.FC = () => {
  const userName: string = 'superadmin';

  return (
    <Layout className={`${styles.sidebar} ${styles['sidebar-layout']}`}>
      <Header className={`${styles.sidebar} ${styles['sidebar-header']}`}>
        <img src="/src/assets/wospLogo.png" alt="WOSP Logo" />
      </Header>
      <Layout className={`${styles.sidebar} ${styles['sidebar-content']}`}>
        <a href="">Strona Główna</a>
        <a href="">Przeliczone puszki</a>
        <a href="">Administracja</a>
        <a href="">Puszki</a>
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
