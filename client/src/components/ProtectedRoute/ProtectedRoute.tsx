import React from 'react';
import { Navigate } from 'react-router-dom';
import { useAuthContext } from '@/utils';

interface Props {
  reversed?: boolean;
  redirectTo?: string;
  children: JSX.Element;
  adminOnly?: boolean;
}

export const ProtectedRoute = ({
  reversed,
  children,
  redirectTo = '/liczymy/login',
  adminOnly = false,
}: Props) => {
  const { credentials, username } = useAuthContext();

  // if reversed is set to true, redirects when user is authenticated
  const shouldRedirect = !((credentials || reversed) && !(credentials && reversed));
  const userIsNotAdmin = adminOnly && !isNaN(parseInt(username?.slice(-2) as string));
  if (shouldRedirect || userIsNotAdmin) {
    return <Navigate to={redirectTo} replace />;
  }
  return children;
};
