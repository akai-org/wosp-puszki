import {
  ADMIN_ROUTE_NAME,
  BOXES_ROUTE_NAME,
  COUNTED_BOXES_ROUTE_NAME,
  MAIN_ROUTE_NAME,
  STATIONS_ROUTE_NAME,
} from './Paths';

export const LINKS_ICONS = new Map();

LINKS_ICONS.set(MAIN_ROUTE_NAME, 'material-symbols:home-outline-rounded');
LINKS_ICONS.set(
  COUNTED_BOXES_ROUTE_NAME,
  'material-symbols:account-balance-wallet-outline',
);
LINKS_ICONS.set(
  ADMIN_ROUTE_NAME,
  'material-symbols:admin-panel-settings-outline-rounded',
);
LINKS_ICONS.set(BOXES_ROUTE_NAME, 'mingcute:box-3-line');
LINKS_ICONS.set(STATIONS_ROUTE_NAME, 'material-symbols:map-outline');
