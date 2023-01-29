import React from 'react';
import { Navigate } from 'react-router-dom';
import { useAuthContext } from '@/utils';

interface Props {
  reversed?: boolean;
  redirectTo?: string;
  children: JSX.Element;
}

export const ProtectedRoute = ({
  reversed,
  children,
  redirectTo = '/liczymy/login',
}: Props) => {
  const { credentials } = useAuthContext();

  // if reversed is set to true, redirects when user is authenticated
  const shouldRedirect = !((credentials || reversed) && !(credentials && reversed));
  if (shouldRedirect) {
    return <Navigate to={redirectTo} replace />;
  }
  return children;
};
