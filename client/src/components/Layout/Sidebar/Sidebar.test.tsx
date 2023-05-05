import { AllRootProvidersWrapper, renderWithWrapper } from '@tests/utils/wrappers';
import { screen } from '@testing-library/react';
import { Sidebar } from './Sidebar';

const testArgs = {
  adminLinks: [
    {
      label: 'Strona Główna',
      url: '',
    },
    {
      label: 'Przeliczone puszki',
      url: 'counted_boxes',
    },
    {
      label: 'Admin',
      url: 'admin',
    },
    {
      label: 'Puszki',
      url: 'boxes',
    },
  ],
  userLinks: [
    {
      label: 'Strona Główna',
      url: '',
    },
    {
      label: 'Puszki',
      url: 'boxes',
    },
  ],
  credentials: 'abcd',
};

describe('Testing of Sidebar', () => {
  describe('Not matter which user is logged in', () => {
    beforeEach(() => {
      renderWithWrapper(
        <Sidebar
          links={testArgs.adminLinks}
          username="user"
          show={true}
          credentials={testArgs.credentials}
          deleteCredentials={() => {
            return;
          }}
          toggleSidebar={() => {
            return;
          }}
        />,
        AllRootProvidersWrapper(),
      );
    });

    it('should show logo', () => {
      const logo = screen.getByAltText('WOSP Logo');
      expect(logo).toBeInTheDocument();
    });
    it('should show username', () => {
      const userNameDescription = screen.getByTestId('userNameDescription');
      expect(userNameDescription).toBeInTheDocument();
    });
    it('should show logout button', () => {
      const logOutButton = screen.getByTestId('logOutButton');
      expect(logOutButton).toBeInTheDocument();
    });
    it('should show toggle bar button', () => {
      const toggleSidebarButton = screen.getByTestId('toggleSidebarButton');
      expect(toggleSidebarButton).toBeInTheDocument();
    });
  });

  describe('Admin', () => {
    beforeEach(() => {
      renderWithWrapper(
        <Sidebar
          links={testArgs.adminLinks}
          username="superadmin"
          show={true}
          credentials={testArgs.credentials}
          deleteCredentials={() => {
            return;
          }}
          toggleSidebar={() => {
            return;
          }}
        />,
        AllRootProvidersWrapper(),
      );
    });

    it('should show four links', () => {
      const links = screen.getAllByTestId('sidebarLinks');
      expect(links.length).toEqual(4);
    });
  });

  describe('User', () => {
    beforeEach(() => {
      renderWithWrapper(
        <Sidebar
          links={testArgs.userLinks}
          username="wosp01"
          show={true}
          credentials={testArgs.credentials}
          deleteCredentials={() => {
            return;
          }}
          toggleSidebar={() => {
            return;
          }}
        />,
        AllRootProvidersWrapper(),
      );
    });

    it('should show two links', () => {
      const links = screen.getAllByTestId('sidebarLinks');
      expect(links.length).toEqual(2);
    });
  });
});
