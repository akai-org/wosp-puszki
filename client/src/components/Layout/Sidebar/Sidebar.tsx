import { FC } from 'react';
import { SidebarSmall, SidebarBig } from './SidebarVariants';

const links = [
  { label: 'Strona Główna', url: '' },
  { label: 'Przeliczone puszki', url: 'countedBoxes' },
  { label: 'Administracja', url: 'admin' },
  { label: 'Puszki', url: 'boxes' },
];

interface Props {
  isLoggedIn: boolean;
}

const userName = 'superadmin';

export const Sidebar: FC<Props> = ({ isLoggedIn }) => {
  return isLoggedIn ? <SidebarBig links={links} userName={userName} /> : <SidebarSmall />;
};
