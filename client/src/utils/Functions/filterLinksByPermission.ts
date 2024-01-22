import { filter } from 'lodash';
import { NavLink, UserRole } from '../types';
import { getTopPermission } from './getTopPermission';
import { permissions } from '../Constants';

export function filterLinksByPermission(links: NavLink[], roles: UserRole[]) {
  const topPermission = getTopPermission(roles);
  if (!topPermission) return [];
  return filter(links, ({ permission }) => topPermission <= permissions[permission]);
}
