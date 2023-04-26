import { FC, useState } from 'react';
import { Logged, NoLogged } from './SidebarVariants';
import { useAuthContext, getSidebarLinks } from '@/utils';

export const Sidebar: FC = () => {
  // Jakiś state który będzie przechowywał informacje o tym czy pasek ma być zwinięty ( trzeba sprawdzić co się dzieje po zmianie strony, jeśli nie zapamiętuje stanu to trzeba dodać jakiś provider który to przechowuje )
  const { deleteCredentials, username, credentials } = useAuthContext();
  const links = getSidebarLinks(username);

  const { show, toggleSidebar } = useToggleSidebar(true);

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

const useToggleSidebar = (startState: boolean) => {
  const [show, setShowState] = useState(startState);
  const toggleSidebar = () => setShowState(!show);

  return { show, toggleSidebar };
};
