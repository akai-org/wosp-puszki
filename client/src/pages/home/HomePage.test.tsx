import { describe, it } from 'vitest';
import { fireEvent, waitFor } from '@testing-library/react';
import { HomePage } from '@/pages';
import { APIManager } from '@/utils';
import {
  AllRootProvidersWrapper,
  baseAuthContextValues,
  COLLECTED_PLN_ID,
  COLLECTED_TOTAL_ID,
  mockEndpoint,
  renderWithWrapper,
} from '@tests/utils';

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
    const { getByTestId, getByText } = renderWithWrapper(
      <HomePage />,
      AllRootProvidersWrapper(),
    );
    expect(getByText('Wydaj puszkę wolontariuszowi')).toBeInTheDocument();
    expect(getByText('Rozlicz puszkę')).toBeInTheDocument();
    expect(getByTestId('collected-pln-test-id')).toBeInTheDocument();
    expect(getByTestId('collected-total-test-id')).toBeInTheDocument();
  });

  it.concurrent('Testing proper rendering when wosp01 is logged in', ({ expect }) => {
    const { getByTestId, queryByText, getByText } = renderWithWrapper(
      <HomePage />,
      AllRootProvidersWrapper({
        authContextValues: () => ({
          ...baseAuthContextValues,
          username: 'wosp01',
        }),
      }),
    );

    expect(queryByText('Wydaj puszkę wolontariuszowi')).toBeNull();
    expect(getByText('Rozlicz puszkę')).toBeInTheDocument();

    expect(getByTestId(COLLECTED_PLN_ID)).toHaveTextContent('0 zł');
    expect(getByTestId(COLLECTED_TOTAL_ID)).toHaveTextContent('0 zł');
  });

  it.concurrent("Test clicking 'Wydaj puszkę wolontariuszowi' link", ({ expect }) => {
    const { getByText } = renderWithWrapper(<HomePage />, AllRootProvidersWrapper());
    const button = getByText('Wydaj puszkę wolontariuszowi');
    fireEvent.click(button);
    expect(window.location.pathname).toBe('/boxes');
  });

  it.concurrent("Test clicking 'Rozlicz puszkę' link", ({ expect }) => {
    const { getByText } = renderWithWrapper(<HomePage />, AllRootProvidersWrapper());
    const button = getByText('Rozlicz puszkę');
    fireEvent.click(button);
    expect(window.location.pathname).toBe('/boxes/settle');
  });

  it.concurrent('Test displaying data returned from API', async ({ expect }) => {
    const { getByText } = renderWithWrapper(<HomePage />, AllRootProvidersWrapper());
    await waitFor(() => expect(getByText('100 zł')).toBeInTheDocument());
    await waitFor(() => expect(getByText('200 zł')).toBeInTheDocument());
  });
});
