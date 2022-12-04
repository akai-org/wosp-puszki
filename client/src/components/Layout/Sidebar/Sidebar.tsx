import React, { FC } from 'react';
import { SidebarSmall, SidebarBig } from './SidebarVariants';

const links = [
  { name: 'Strona Główna', url: '/home' },
  { name: 'Przeliczone puszki', url: '/count' },
  { name: 'Administracja', url: '/admin' },
  { name: 'Puszki', url: '/box' },
];

interface Props {
  isLoggedIn: boolean;
}

export const Sidebar: FC<Props> = ({ isLoggedIn }) => {
  const userName = 'superadmin';

  return isLoggedIn ? <SidebarBig links={links} userName={userName} /> : <SidebarSmall />;
};
