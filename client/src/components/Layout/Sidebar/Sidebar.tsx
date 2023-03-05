import { FC } from 'react';
import { SidebarSmall, SidebarBig } from './SidebarVariants';
import { SETTLE_PROCESS_PATH, useAuthContext } from '@/utils';

const links = [
  { label: 'Strona Główna', url: '' },
  // { label: 'Przeliczone puszki', url: 'countedBoxes' },
  // { label: 'Administracja', url: 'admin' },
  { label: 'Puszki', url: SETTLE_PROCESS_PATH },
];

export const Sidebar: FC = () => {
  const { deleteCredentials, username, credentials } = useAuthContext();
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
