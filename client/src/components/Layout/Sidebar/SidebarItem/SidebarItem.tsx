import React from 'react';
import { NavLink } from 'react-router-dom';
import { SubNavLink } from '@/utils';
import s from './SidebarItem.module.less';

export const SidebarItem: React.FC<SubNavLink> = (props) => {
  return (
    <NavLink
      to={`${props.url}`}
      end
      className={({ isActive }) =>
        isActive ? [s.sideBarItem, s.active].join(' ') : s.sideBarItem
      }
    >
      {props.label}
    </NavLink>
  );
};
