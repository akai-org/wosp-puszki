import { Layout } from 'antd';
import Logo from '@/assets/wosp.svg';
const { Header } = Layout;
import styles from '../Sidebar.module.less';
import type { FC } from 'react';

export const SidebarSmall: FC = () => {
  return (
    <Layout
      className={[styles.sidebar, styles.sidebarLayout, styles.sidebarLoginPage].join(
        ' ',
      )}
    >
      <Header className={[styles.sidebar, styles.sidebarHeader].join(' ')}>
        <img src={Logo} alt="WOSP Logo" />
      </Header>
    </Layout>
  );
};
