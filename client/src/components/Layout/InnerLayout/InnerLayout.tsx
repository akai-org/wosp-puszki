import { Outlet } from 'react-router-dom';
import { Layout } from 'antd';
import s from './InnerLayout.module.css';
import { SubNavLink } from '@/utils';
import { FC } from 'react';
import NavbarItem from '../Navbar/NavbarItem';

interface Props {
  links: SubNavLink[];
}

export const InnerLayout: FC<Props> = ({ links }) => {
  return (
    <Layout>
      <Layout.Header className={s.customNavbar}>
        {/* <h1>Header</h1> */}
        <NavbarItem url="/admin" label="Dodaj użytkownika" withDot />
        <NavbarItem url="/puszka" label="Lista użytkowników" />
      </Layout.Header>
      <Layout.Content>
        <Outlet />
      </Layout.Content>
    </Layout>
  );
};
