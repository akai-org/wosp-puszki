import { Button, Layout } from 'antd';
import React from 'react';
import s from '../Sidebar.module.less';
import Logo from '@/assets/wosp.svg';
import { SidebarItem } from '@components/Layout/Sidebar/SidebarItem/SidebarItem';
import { SubNavLink } from '@/utils';

const { Header, Footer } = Layout;

type SidebarData = {
  show: boolean;
  userName: string;
  links: SubNavLink[];
  toggleSidebar: () => void;
  deleteCredentials: () => void;
};

// Zrobić jakąś destrukturyzacje propsów
export const Logged: React.FC<SidebarData> = (props) => {
  const handleLogout = () => {
    props.deleteCredentials();
  };

  // Ogarnąć by to wyglądało tak jak w Figmie, ikony itp.
  return (
    <Layout className={[s.sidebar, s.sidebarLayout].join(' ')}>
      <Header className={[s.sidebar, s.sidebarHeader].join(' ')}>
        <img src={Logo} alt="WOSP Logo" />
      </Header>
      <Layout className={[s.sidebar, s.sidebarContent].join(' ')}>
        {props.links.map((item) => (
          <SidebarItem label={item.label} url={item.url} key={item.label} />
        ))}
      </Layout>
      <Footer className={[s.sidebar, s.sidebarFooter].join(' ')}>
        <p>Użytkownik:</p>
        <p className={s.userName}>{props.userName}</p>
        <Button onClick={handleLogout} type="primary">
          Wyloguj
        </Button>
      </Footer>
    </Layout>
  );
};
