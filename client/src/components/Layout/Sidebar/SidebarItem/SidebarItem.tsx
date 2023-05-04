import React from 'react';
import { NavLink } from 'react-router-dom';
import { SubNavLink } from '@/utils';
import s from './SidebarItem.module.less';
import { Icon } from '@iconify/react';
import { LINKS_ICONS } from '@/utils/Constants/LinksIcons';

export const SidebarItem: React.FC<SubNavLink> = ({ url, label, show }) => {
  return (
    <NavLink
      to={url}
      end={url === ''}
      className={({ isActive }) =>
        isActive
          ? [s.sideBarItem, s.active, show ? s.show : null].join(' ')
          : [s.sideBarItem, show ? s.show : null].join(' ')
      }
    >
      <div data-testid="sidebarLinks" className={s.sidebarItemContent}>
        <Icon icon={LINKS_ICONS.get(label)} color="white" width="20" height="20" />
        {show ? label : null}
      </div>
    </NavLink>
  );
};
