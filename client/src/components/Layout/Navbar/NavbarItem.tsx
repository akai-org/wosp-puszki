import React from 'react';
import { NavLink } from 'react-router-dom';
import s from './NavbarItem.module.less';
import { SubNavLink } from '@/utils';

export const NavbarItem: React.FC<SubNavLink> = (props) => {
  return (
    <>
      <NavLink
        to={props.url}
        end
        className={({ isActive }) =>
          isActive ? [s.navbarItem, s.active].join(' ') : s.navbarItem
        }
      >
        {props.label}
      </NavLink>
      {props.withDot && <span className={s.dot}></span>}
    </>
  );
};
