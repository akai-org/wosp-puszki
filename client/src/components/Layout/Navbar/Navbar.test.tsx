import { AllRootProvidersWrapper, renderWithWrapper } from '@tests/utils/wrappers';
import { screen } from '@testing-library/react';
import { Navbar } from './Navbar';

const testArgs = {
  CountedBoxesNavLinks: [
    {
      label: 'Lista puszek',
      url: 'countedBoxes',
    },
  ],
  AdminPanelNavLinks: [
    {
      label: 'Dodaj użytkownika',
      url: 'admin/users/add',
    },
    {
      label: 'Lista użytkowników',
      url: 'admin',
      withDot: true,
    },
    {
      label: 'Dodaj wolontariusza',
      url: 'admin/volunteers/add',
    },
    {
      label: 'Lista wolontariuszy',
      url: 'admin/volunteers/list',
      withDot: true,
    },
    {
      label: 'Logi',
      url: 'admin/logs',
    },
  ],
  GiveOrSettleBoxNavLinks: [
    {
      label: 'Wydaj puszkę',
      url: 'boxes',
    },
    {
      label: 'Rozlicz puszkę',
      url: 'boxes/settle',
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
