import { AllRootProvidersWrapper, renderWithWrapper } from '@tests/utils/wrappers';
import { screen } from '@testing-library/react';
import { Navbar } from './Navbar';
import { SubNavLink } from '@/utils';

const testArgs: {
  CountedBoxesNavLinks: SubNavLink[];
  AdminPanelNavLinks: SubNavLink[];
  GiveOrSettleBoxNavLinks: SubNavLink[];
} = {
  CountedBoxesNavLinks: [
    {
      label: 'Lista puszek',
      url: 'countedBoxes',
      permission: 'volounteer',
    },
  ],
  AdminPanelNavLinks: [
    {
      label: 'Dodaj użytkownika',
      url: 'admin/users/add',
      permission: 'volounteer',
    },
    {
      label: 'Lista użytkowników',
      url: 'admin',
      withDot: true,
      permission: 'volounteer',
    },
    {
      label: 'Dodaj wolontariusza',
      url: 'admin/volunteers/add',
      permission: 'volounteer',
    },
    {
      label: 'Lista wolontariuszy',
      url: 'admin/volunteers/list',
      withDot: true,
      permission: 'volounteer',
    },
    {
      label: 'Logi',
      url: 'admin/logs',
      permission: 'volounteer',
    },
  ],
  GiveOrSettleBoxNavLinks: [
    {
      label: 'Wydaj puszkę',
      url: 'boxes',
      permission: 'volounteer',
    },
    {
      label: 'Rozlicz puszkę',
      url: 'boxes/settle',
      permission: 'volounteer',
    },
  ],
};

describe('Testing Navbars', () => {
  describe('CountedBoxesNav', () => {
    beforeEach(() => {
      renderWithWrapper(
        <Navbar links={testArgs.CountedBoxesNavLinks} />,
        AllRootProvidersWrapper(),
      );
    });
    it('should show two links', () => {
      const links = screen.getAllByTestId('navbarLinks');
      expect(links.length).toEqual(2);
    });
  });

  describe('AdminPanelNav', () => {
    beforeEach(() => {
      renderWithWrapper(
        <Navbar links={testArgs.AdminPanelNavLinks} />,
        AllRootProvidersWrapper(),
      );
    });
    it('should show four links', () => {
      const links = screen.getAllByTestId('navbarLinks');
      expect(links.length).toEqual(5);
    });
    it('should have two dots', () => {
      const dots = screen.getAllByTestId('navbarDot');
      expect(dots.length).toEqual(2);
    });
  });

  describe('GiveOrSettleBoxNavLinks', () => {
    beforeEach(() => {
      renderWithWrapper(
        <Navbar links={testArgs.GiveOrSettleBoxNavLinks} />,
        AllRootProvidersWrapper(),
      );
    });
    it('should show two links', () => {
      const links = screen.getAllByTestId('navbarLinks');
      expect(links.length).toEqual(2);
    });
  });
});
