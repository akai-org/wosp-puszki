import React from 'react';
import { Navigate } from 'react-router-dom';
import { UserRole, permissions, useAuthContext } from '@/utils';
import {
  difference,
  differenceBy,
  differenceWith,
  filter,
  intersectionWith,
  sortBy,
} from 'lodash';

interface Props {
  reversed?: boolean;
  redirectTo?: string;
  children: JSX.Element;
  permission?: UserRole;
}

export const ProtectedRoute = ({
  reversed,
  children,
  redirectTo = '/liczymy/login',
  permission = 'volounteer',
}: Props) => {
  const { credentials, roles, deleteCredentials } = useAuthContext();
  const sortedPermissions = sortBy(Object.entries(permissions), ([, value]) => value);
  const overlappingPermissions = intersectionWith(
    sortedPermissions,
    roles,
    ([permission], role) => {
      return permission === role;
    },
  );
  const shouldRedirect = !((credentials || reversed) && !(credentials && reversed));

  if (overlappingPermissions.length) {
    const topPermission = overlappingPermissions[0][1];

    const isProperPermission = topPermission <= permissions[permission];
    if (shouldRedirect || !isProperPermission) {
      return <Navigate to={redirectTo} replace />;
    }
    return children;
  }

  // if reversed is set to true, redirects when user is authenticated
  // console.log(shouldRedirect);
  if (shouldRedirect) {
    return <Navigate to={redirectTo} replace />;
  }
  return children;
};
