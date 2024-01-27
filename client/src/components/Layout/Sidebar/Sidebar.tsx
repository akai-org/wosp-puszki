import { FC } from 'react';
import { Logged, NoLogged } from './SidebarVariants';
import { NavLink } from '@/utils';

interface SidebarTypes {
  links: NavLink[];
  username: string | null;
  show: boolean;
  credentials: string | null;
  deleteCredentials: () => void;
  toggleSidebar: () => void;
}

export const Sidebar: FC<SidebarTypes> = ({
  links,
  username,
  show,
  credentials,
  deleteCredentials,
  toggleSidebar,
}) => {
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
