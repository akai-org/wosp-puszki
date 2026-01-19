import {
  ADMIN_PATH,
  ADMIN_ROUTE_NAME,
  BOXES_ROUTE_NAME,
  COUNTED_BOXES_PATH,
  COUNTED_BOXES_ROUTE_NAME,
  filterLinksByPermission,
  getTopPermission,
  MAIN_ROUTE_NAME,
  NavLink,
  permissions,
  SETTLE_PROCESS_PATH,
  STATIONS_MAP_PATH,
  STATIONS_ROUTE_NAME,
  UserRole,
  VOLUNTEERS_LIST_PAGE_ROUTE,
} from '@/utils';

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
      label: STATIONS_ROUTE_NAME,
      url: STATIONS_MAP_PATH,
      permission: 'movementcontroller',
    },
  ];
  return filterLinksByPermission(links, roles);
};
