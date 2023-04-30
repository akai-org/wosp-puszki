import React from 'react';
import { NavLink } from 'react-router-dom';
import { SubNavLink } from '@/utils';
import s from './SidebarItem.module.less';
import { Icon } from '@iconify/react';
import { LINKS_ICONS } from '@/utils/Constants/LinksIcons';
import { Tooltip } from 'antd';

export const SidebarItem: React.FC<SubNavLink> = ({ url, label, show }) => {
  console.log(url, label);
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
      {show ? (
        <div className={s.sidebarItemContent}>
          <Icon icon={LINKS_ICONS.get(label)} color="white" width="20" height="20" />
          {label}
        </div>
      ) : (
        <Tooltip title={label} placement="right">
          <Icon icon={LINKS_ICONS.get(label)} color="white" width="20" height="20" />
        </Tooltip>
      )}
    </NavLink>
  );
};
