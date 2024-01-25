import { permissions } from './Constants';
import { UserRole } from './types';

export function isUserRole(userRole: string): userRole is UserRole {
  return Object.keys(permissions).includes(userRole);
}
