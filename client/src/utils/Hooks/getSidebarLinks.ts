import {
  SETTLE_PROCESS_PATH,
  ADMIN_PATH,
  SUPER_ADMIN,
  COUNTED_BOXES_PATH,
  MAIN_ROUTE_NAME,
  COUNTED_BOXES_ROUTE_NAME,
  ADMIN_ROUTE_NAME,
  BOXES_ROUTE_NAME,
} from '../Constants';

export const getSidebarLinks = (username: string | null) => {
  if (username === SUPER_ADMIN) {
    return [
      { label: MAIN_ROUTE_NAME, url: '' },
      { label: COUNTED_BOXES_ROUTE_NAME, url: COUNTED_BOXES_PATH },
      { label: ADMIN_ROUTE_NAME, url: ADMIN_PATH },
      { label: BOXES_ROUTE_NAME, url: SETTLE_PROCESS_PATH },
    ];
  }
  return [
    { label: MAIN_ROUTE_NAME, url: '' },
    { label: BOXES_ROUTE_NAME, url: SETTLE_PROCESS_PATH },
  ];
};
