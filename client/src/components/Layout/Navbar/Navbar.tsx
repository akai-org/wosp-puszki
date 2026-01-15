import { NavbarItem } from '../Navbar/NavbarItem';
import { SubNavLink } from '@/utils';
import { FC } from 'react';
import s from './Navbar.module.less';

interface Props {
  links: SubNavLink[];
}

export const Navbar: FC<Props> = ({ links }) => {
  return (
    <div className={s.navbar}>
      {links.map((item) => (
        <NavbarItem
          url={item.url}
          label={item.label}
          withDot={item.withDot}
          key={item.label}
        />
      ))}
    </div>
  );
};
