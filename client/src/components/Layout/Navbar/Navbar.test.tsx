import { AllRootProvidersWrapper, renderWithWrapper } from '@tests/utils/wrappers';
import { screen } from '@testing-library/react';
import { Navbar } from './Navbar';

const testArgs = {
  CountedBoxesNavLinks: [
    {
      label: 'Lista puszek do zatwierdzenia',
      url: 'countedBoxes',
      show: true,
    },
    {
      label: 'Lista puszek zatwierdzonych',
      url: 'countedBoxes/approved',
      show: true,
    },
  ],
  AdminPanelNavLinks: [
    {
      label: 'Dodaj użytkownika',
      url: 'admin/users/add',
      show: true,
    },
    {
      label: 'Lista użytkowników',
      url: 'admin',
      show: true,
      withDot: true,
    },
    {
      label: 'Dodaj wolontariusza',
      url: 'admin/volunteers/add',
      show: true,
    },
    {
      label: 'Lista wolontariuszy',
      url: 'admin/volunteers/list',
      show: true,
      withDot: true,
    },
    {
      label: 'Logi',
      url: 'admin/logs',
      show: true,
    },
  ],
  GiveOrSettleBoxNavLinks: [
    {
      label: 'Wydaj puszkę',
      url: 'boxes',
      show: true,
    },
    {
      label: 'Rozlicz puszkę',
      url: 'boxes/settle',
      show: true,
    },
  ],
};

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