import React from 'react';
import SidebarBig from './SidebarBig';
import SidebarSmall from './SidebarSmall';

const links = [
  { name: 'Strona Główna', url: '/home' },
  { name: 'Przeliczone puszki', url: '/count' },
  { name: 'Administracja', url: '/admin' },
  { name: 'Puszki', url: '/box' },
];

const Sidebar: React.FC = () => {
  const userName = 'superadmin';
  const isLogin = true;

  return (
    <>{!isLogin ? <SidebarSmall /> : <SidebarBig links={links} userName={userName} />}</>
  );
};

export default Sidebar;
