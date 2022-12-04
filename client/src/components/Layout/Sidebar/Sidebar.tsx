import React from 'react';
import { SidebarSmall, SidebarBig } from './SidebarVariants';

const links = [
  { name: 'Strona Główna', url: '/home' },
  { name: 'Przeliczone puszki', url: '/count' },
  { name: 'Administracja', url: '/admin' },
  { name: 'Puszki', url: '/box' },
];

export const Sidebar: React.FC = () => {
  const userName = 'superadmin';
  const isLogin = true;

  return isLogin ? <SidebarBig links={links} userName={userName} /> : <SidebarSmall />;
};
