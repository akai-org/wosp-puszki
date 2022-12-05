import React from 'react';
import { NavLink } from 'react-router-dom';
import s from './NavbarItem.module.less';

type Item = {
  url: string;
  label: string;
  withDot?: boolean;
};

const NavbarItem: React.FC<Item> = (props) => {
  return (
    <>
      <NavLink
        to={props.url}
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

export default NavbarItem;
