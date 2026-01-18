import React, { JSX } from 'react';
import { Navigate } from 'react-router-dom';
import {
  COUNTED_BY_ROUTE,
  getTopPermission,
  LOGIN_ROUTE,
  MAIN_ROUTE,
  permissions,
  useAuthContext,
  useCountedByContext,
  UserRole,
} from '@/utils';
import _ from 'lodash';

interface Props {
  reversed?: boolean;
  redirectTo?: string;
  children: JSX.Element;
  permission?: UserRole;
}

export const ProtectedRoute = ({
  reversed,
  children,
  redirectTo = `/${MAIN_ROUTE}/${LOGIN_ROUTE}`,
  permission = 'volounteer',
}: Props) => {
  const { credentials, roles } = useAuthContext();
  const { countedBy } = useCountedByContext();
  const topPermission = getTopPermission(roles);
  // if reversed is set to true, redirects when user is authenticated
  const shouldRedirect = !((credentials || reversed) && !(credentials && reversed));
  if (topPermission) {
    const isProperPermission = topPermission <= permissions[permission];
    if (shouldRedirect || !isProperPermission) {
      return <Navigate to={redirectTo} replace />;
    }
    if (_.isEmpty(countedBy) && topPermission >= permissions['volounteer']) {
      return <Navigate to={`/${MAIN_ROUTE}/${COUNTED_BY_ROUTE}`} replace />;
    }
    return children;
  }

  if (shouldRedirect && !topPermission) {
    return <Navigate to={redirectTo} replace />;
  }
  return children;
};
