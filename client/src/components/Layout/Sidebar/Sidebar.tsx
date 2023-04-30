import { FC } from 'react';
import { Logged, NoLogged } from './SidebarVariants';
import { useAuthContext, getSidebarLinks, useSidebarStateContext } from '@/utils';

export const Sidebar: FC = () => {
  const { deleteCredentials, username, credentials } = useAuthContext();
  const links = getSidebarLinks(username);

  const { show, toggleSidebar } = useSidebarStateContext();

  return credentials ? (
    <Logged
      deleteCredentials={deleteCredentials}
      links={links}
      userName={username as string}
      show={show}
      toggleSidebar={toggleSidebar}
    />
  ) : (
    <NoLogged />
  );
};
