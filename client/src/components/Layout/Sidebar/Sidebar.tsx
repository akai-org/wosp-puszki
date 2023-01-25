import { FC, useContext } from 'react';
import { SidebarSmall, SidebarBig } from './SidebarVariants';
import { AuthContext } from '@/App';
import { IAuthContext } from '@/utils';

const links = [
  { label: 'Strona Główna', url: '' },
  { label: 'Przeliczone puszki', url: 'countedBoxes' },
  { label: 'Administracja', url: 'admin' },
  { label: 'Puszki', url: 'boxes' },
];

export const Sidebar: FC = () => {
  const { deleteCredentials, username, credentials } = useContext(
    AuthContext,
  ) as IAuthContext;
  return credentials ? (
    <SidebarBig
      deleteCredentials={deleteCredentials}
      links={links}
      userName={username as string}
    />
  ) : (
    <SidebarSmall />
  );
};
