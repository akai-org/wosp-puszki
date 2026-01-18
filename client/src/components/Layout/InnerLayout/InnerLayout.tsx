import { Outlet } from 'react-router-dom';
import { Layout } from 'antd';
import s from './InnerLayout.module.less';
import {
  filterLinksByPermission,
  SubNavLink,
  useAuthContext,
  useCountedByContext,
} from '@/utils';
import { FC } from 'react';
import { Navbar } from '../Navbar/Navbar';
import { Footer } from '@components/Layout/Footer/Footer';

interface Props {
  links: SubNavLink[];
  hideNavbar?: boolean;
  showFooter?: boolean;
}

export const InnerLayout: FC<Props> = ({ links, hideNavbar, showFooter = false }) => {
  const { roles } = useAuthContext();
  const { countedBy } = useCountedByContext();
  const layoutHeader = hideNavbar ? null : (
    <Layout.Header className={s.customNavbar}>
      <Navbar links={filterLinksByPermission(links, roles)} />
    </Layout.Header>
  );

  const layoutFooter = showFooter ? (
    <Layout.Footer>
      <Footer countedBy={countedBy} />
    </Layout.Footer>
  ) : null;

  return (
    <Layout className={s.layout}>
      {layoutHeader}
      <Layout.Content>
        <Outlet />
      </Layout.Content>
      {layoutFooter}
    </Layout>
  );
};
