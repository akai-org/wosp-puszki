import NavbarItem from '../Navbar/NavbarItem';
import { SubNavLink } from '@/utils';
import { FC } from 'react';
import s from './Navbar.module.less';

interface Props {
  links: SubNavLink[];
}

const Navbar: FC<Props> = (links) => {
  return (
    <div className={s.navbar}>
      <NavbarItem url="/admin" label="Dodaj użytkownika" withDot />
      <NavbarItem url="/puszka" label="Lista użytkowników" />
    </div>
  );
};

export default Navbar;
