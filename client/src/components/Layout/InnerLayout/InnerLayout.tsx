import { Outlet } from 'react-router-dom';
import { Layout } from 'antd';
import s from './InnerLayout.module.less';
import { SubNavLink, filterLinksByPermission, useAuthContext } from '@/utils';
import { FC } from 'react';
import { Navbar } from '../Navbar/Navbar';

interface Props {
  links: SubNavLink[];
  hideNavbar?: boolean;
}

export const InnerLayout: FC<Props> = ({ links, hideNavbar }) => {
  const { roles } = useAuthContext();
  const layoutHeader = hideNavbar ? null : (
    <Layout.Header className={s.customNavbar}>
      <Navbar links={filterLinksByPermission(links, roles)} />
    </Layout.Header>
  );

  return (
    <Layout className={s.layout}>
      {layoutHeader}
      <Layout.Content>
        <Outlet />
      </Layout.Content>
    </Layout>
  );
};
