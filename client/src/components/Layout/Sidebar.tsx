import React from 'react';
import SidebarBig from './SidebarBig';
import SidebarSmall from './SidebarSmall';

interface Props {
  isLoggedIn: boolean;
}

const links = [
  { name: 'Strona Główna', url: 'home' },
  { name: 'Przeliczone puszki', url: 'count' },
  { name: 'Administracja', url: 'admin' },
  { name: 'Puszki', url: 'box' },
];

const Sidebar: React.FC<Props> = ({ isLoggedIn }) => {
  const userName = 'superadmin';

  return (
    <>
      {!isLoggedIn ? <SidebarSmall /> : <SidebarBig links={links} userName={userName} />}
    </>
  );
};

export default Sidebar;
