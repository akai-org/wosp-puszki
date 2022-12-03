import { Outlet } from 'react-router-dom';
import { Layout } from 'antd';

import s from './InnerLayout.module.css';

export const InnerLayout = () => {
  return (
    <Layout>
      <Layout.Header className={s.customNavbar}>
        <h1>Header</h1>
      </Layout.Header>
      <Layout.Content>
        <Outlet />
      </Layout.Content>
    </Layout>
  );
};
