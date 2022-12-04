import { Button, Layout } from 'antd';
import React from 'react';
import styles from '../Sidebar.module.less';
import Logo from '@/assets/wosp.svg';
import SidebarItem from '@components/Layout/Sidebar/SidebarItem/SidebarItem';

const { Header, Footer } = Layout;

type sidebarData = {
  links: { name: string; url: string }[];
  userName: string;
};

export const SidebarBig: React.FC<sidebarData> = (props) => {
  return (
    <Layout className={[styles.sidebar, styles.sidebarLayout].join(' ')}>
      <Header className={[styles.sidebar, styles.sidebarHeader].join(' ')}>
        <img src={Logo} alt="WOSP Logo" />
      </Header>
      <Layout className={[styles.sidebar, styles.sidebarContent].join(' ')}>
        {props.links.map((item) => (
          <SidebarItem name={item.name} url={item.url} key={item.name} />
        ))}
      </Layout>
      <Footer className={[styles.sidebar, styles.sidebarFooter].join(' ')}>
        <p>Użytkownik:</p>
        <p className={styles.userName}>{props.userName}</p>
        <Button type="primary">Wyloguj</Button>
      </Footer>
    </Layout>
  );
};
