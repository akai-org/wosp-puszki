import React from 'react';
import { Navigate } from 'react-router-dom';

interface Props {
  isAllowed: boolean;
  redirectTo?: string;
  children: JSX.Element;
}

export const ProtectedRoute = ({ isAllowed, children, redirectTo = '/login' }: Props) => {
  if (!isAllowed) {
    return <Navigate to={redirectTo} replace />;
  }
  return children;
};
