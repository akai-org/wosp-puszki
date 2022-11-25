import React from 'react';
import { NavLink } from 'react-router-dom';

import styles from './SidebarItem.module.less';

type Item = {
  name: string;
  url: string;
};

const SidebarItem: React.FC<Item> = (props) => {
  return (
    <NavLink
      to={props.url}
      className={({ isActive }) => (isActive ? styles.active : undefined)}
    >
      {props.name}
    </NavLink>
  );
};

export default SidebarItem;
