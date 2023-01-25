import React, { useContext } from 'react';
import { Navigate } from 'react-router-dom';
import { AuthContext } from '@/App';
import { IAuthContext } from '@/utils';

interface Props {
  reversed?: boolean;
  redirectTo?: string;
  children: JSX.Element;
}

export const ProtectedRoute = ({ reversed, children, redirectTo = '/login' }: Props) => {
  const { credentials } = useContext(AuthContext) as IAuthContext;
  if (!((credentials || reversed) && !(credentials && reversed))) {
    return <Navigate to={redirectTo} replace />;
  }
  return children;
};
