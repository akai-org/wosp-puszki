import {
  SETTLE_PROCESS_PATH,
  ADMIN_PATH,
  COUNTED_BOXES_PATH,
  MAIN_ROUTE_NAME,
  COUNTED_BOXES_ROUTE_NAME,
  ADMIN_ROUTE_NAME,
  BOXES_ROUTE_NAME,
  STATIONS_MAP_PATH,
  STATIONS_MAP_ROUTE_NAME,
  permissions,
  VOLUNTEERS_LIST_PAGE_ROUTE,
} from '../Constants';
import { NavLink, UserRole } from '../types';
import { filterLinksByPermission, getTopPermission } from '../Functions';

export const getSidebarLinks = (roles: UserRole[]) => {
  const topPermission = getTopPermission(roles);
  const links: NavLink[] = [
    { label: MAIN_ROUTE_NAME, url: '', permission: 'movementcontroller' },
    {
      label: COUNTED_BOXES_ROUTE_NAME,
      url: COUNTED_BOXES_PATH,
      permission: 'collectorcoordinator',
    },
    {
      label: ADMIN_ROUTE_NAME,
      url: `${ADMIN_PATH}${
        topPermission !== null && topPermission <= permissions.admin
          ? `/${VOLUNTEERS_LIST_PAGE_ROUTE}`
          : ''
      }`,
      permission: 'admin',
    },
    { label: BOXES_ROUTE_NAME, url: SETTLE_PROCESS_PATH, permission: 'volounteer' },
    {
      label: STATIONS_MAP_ROUTE_NAME,
      url: STATIONS_MAP_PATH,
      permission: 'movementcontroller',
    },
  ];
  return filterLinksByPermission(links, roles);
};
