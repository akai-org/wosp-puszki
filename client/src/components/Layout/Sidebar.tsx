import React from 'react';
import { SidebarSmall } from './SidebarSmall';
import { SidebarBig } from './SidebarBig';

const links = [
  { name: 'Strona Główna', url: '/home' },
  { name: 'Przeliczone puszki', url: '/count' },
  { name: 'Administracja', url: '/admin' },
  { name: 'Puszki', url: '/box' },
];

export const Sidebar: React.FC = () => {
  const userName = 'superadmin';
  const isLogin = true;

  return (
    <>{!isLogin ? <SidebarSmall /> : <SidebarBig links={links} userName={userName} />}</>
  );
};
