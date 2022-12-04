import { Outlet } from 'react-router-dom';
import { Layout } from 'antd';
import s from './InnerLayout.module.css';
import { SubNavLink } from '@/utils';
import { FC } from 'react';

interface Props {
  links: SubNavLink[];
}

export const InnerLayout: FC<Props> = ({ links }) => {
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
