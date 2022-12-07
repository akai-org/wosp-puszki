import { Layout } from 'antd';
import Logo from '@/assets/wosp.svg';
const { Header } = Layout;
import s from '../Sidebar.module.less';
import type { FC } from 'react';

export const SidebarSmall: FC = () => {
  return (
    <Layout className={[s.sidebar, s.sidebarLayout, s.sidebarLoginPage].join(' ')}>
      <Header className={[s.sidebar, s.sidebarHeader].join(' ')}>
        <img src={Logo} alt="WOSP Logo" />
      </Header>
    </Layout>
  );
};
