import { Layout } from 'antd';
import Logo from '@/assets/wosp.svg';
import s from '../Sidebar.module.less';
import type { FC } from 'react';

const { Header } = Layout;

export const NoLogged: FC = () => {
  return (
    <Layout className={[s.sidebar, s.sidebarLayout, s.sidebarLoginPage].join(' ')}>
      <Header className={[s.sidebar, s.sidebarHeader].join(' ')}>
        <img src={Logo} alt="WOSP Logo" />
      </Header>
    </Layout>
  );
};
