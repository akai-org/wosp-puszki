import React from 'react';
import { NavLink, useLocation } from 'react-router-dom';

import styles from './SidebarItem.module.css';

type Item = {
  name: string;
  url: string;
};

const SidebarItem: React.FC<Item> = (props) => {
  const location = useLocation();

  return (
    <NavLink
      to={props.url}
      className={`${styles[`${location.hash === props.url ? 'active' : ''}`]}`}
    >
      {props.name}
    </NavLink>
  );
};

export default SidebarItem;
