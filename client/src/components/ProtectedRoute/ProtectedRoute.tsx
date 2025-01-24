import React, { JSX } from 'react';
import { Navigate } from 'react-router-dom';
import { UserRole, getTopPermission, permissions, useAuthContext } from '@/utils';

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
  const { credentials, roles } = useAuthContext();
  const topPermission = getTopPermission(roles);
  // if reversed is set to true, redirects when user is authenticated
  const shouldRedirect = !((credentials || reversed) && !(credentials && reversed));

  //
  if (topPermission) {
    const isProperPermission = topPermission <= permissions[permission];
    if (shouldRedirect || !isProperPermission) {
      return <Navigate to={redirectTo} replace />;
    }
    return children;
  }

  if (shouldRedirect && !topPermission) {
    return <Navigate to={redirectTo} replace />;
  }
  return children;
};
