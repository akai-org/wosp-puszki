import { intersectionWith, sortBy } from 'lodash';
import { UserRole } from '../types';
import { permissions } from '../Constants';

export function getTopPermission(roles: UserRole[]) {
  const overlappingPermissions = intersectionWith(
    Object.entries(permissions),
    roles,
    ([permission], role) => {
      return permission === role;
    },
  );
  const sortedOberlappingPermissions = sortBy(
    overlappingPermissions,
    ([, value]) => value,
  );

  if (sortedOberlappingPermissions.length === 0) return null;
  return sortedOberlappingPermissions[0][1];
}
