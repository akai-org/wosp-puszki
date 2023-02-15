import { describe, it } from 'vitest';
import { fireEvent, render, waitFor } from '@testing-library/react';
import { HomePage } from '@/pages';
import { ReactElement } from 'react';
import { AllRootProvidersWrapper } from '../../../tests/utils/wrappers';
import { AuthProviderConfig } from '../../../tests/utils/types';
import { baseAuthContextValues } from '../../../tests/utils/basicMockupValues';
import { mockEndpoint } from '../../../tests/utils/MSWSetup';
import { APIManager } from '@/utils';

const renderWithRouter = (ui: ReactElement, config?: AuthProviderConfig) => {
  return {
    ...render(ui, {
      wrapper: AllRootProvidersWrapper(config),
    }),
  };
};

describe('Testing HomePage', () => {
  beforeEach(() => {
    mockEndpoint(`${APIManager.baseAPIRUrl}/stats`, {
      httpVerb: 'get',
      status: 200,
      body: {
        amount_total_in_PLN: 200,
        amount_PLN: 100,
      },
    });
  });
  it.concurrent('Testing proper rendering when superadmin logged in', ({ expect }) => {
    const { getByTestId, getByText } = renderWithRouter(<HomePage />);
    expect(getByText('Wydaj puszkę wolontariuszowi')).toBeInTheDocument();
    expect(getByText('Rozlicz puszkę')).toBeInTheDocument();
    expect(getByTestId('collected-pln-test-id')).toBeInTheDocument();
    expect(getByTestId('collected-total-test-id')).toBeInTheDocument();
  });

  it.concurrent('Testing proper rendering when wosp01 is logged in', ({ expect }) => {
    const { getByTestId, getByText, queryByText } = renderWithRouter(<HomePage />, {
      authContextValues: () => ({
        ...baseAuthContextValues,
        username: 'wosp01',
      }),
    });

    expect(queryByText('Wydaj puszkę wolontariuszowi')).toBeNull();
    expect(getByText('Rozlicz puszkę')).toBeInTheDocument();

    expect(getByTestId('collected-pln-test-id')).toBeInTheDocument();
    expect(getByTestId('collected-total-test-id')).toBeInTheDocument();
    expect(getByTestId('collected-pln-test-id')).toHaveTextContent('0 zł');
    expect(getByTestId('collected-total-test-id')).toHaveTextContent('0 zł');
  });

  it.concurrent("Test clicking 'Wydaj puszkę wolontariuszowi' links", ({ expect }) => {
    const { getByText } = renderWithRouter(<HomePage />);
    const button = getByText('Wydaj puszkę wolontariuszowi');
    fireEvent.click(button);
    expect(window.location.pathname).toBe('/boxes');
  });

  it.concurrent("Test clicking 'Rozlicz puszkę' links", ({ expect }) => {
    const { getByText } = renderWithRouter(<HomePage />);
    const button = getByText('Rozlicz puszkę');
    fireEvent.click(button);
    expect(window.location.pathname).toBe('/boxes/settle');
  });

  it.concurrent('Test displaying data returned from API', async ({ expect }) => {
    const { getByText } = renderWithRouter(<HomePage />);
    await waitFor(() => expect(getByText('100 zł')).toBeInTheDocument());
    await waitFor(() => expect(getByText('200 zł')).toBeInTheDocument());
  });
});
