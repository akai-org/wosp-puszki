import React from 'react';
import { NavLink } from 'react-router-dom';
import { SubNavLink } from '@/utils';
import s from './SidebarItem.module.less';
import { Icon } from '@iconify/react';

export const SidebarItem: React.FC<SubNavLink> = ({ url, label, show }) => {
  return (
    <NavLink
      to={url}
      end={url === ''}
      className={({ isActive }) =>
        isActive ? [s.sideBarItem, s.active].join(' ') : s.sideBarItem
      }
    >
      <Icon icon="majesticons:eye-off-line" color="white" width="20" height="20" />
      {show ? label : null}
    </NavLink>
  );
};
