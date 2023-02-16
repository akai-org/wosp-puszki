import { describe, it } from 'vitest';
import { waitFor } from '@testing-library/react';
import { HomePage } from '@/pages';
import { APIManager } from '@/utils';
import { mockEndpoint } from '@tests/utils/MSWSetup';
import { COLLECTED_PLN_ID, COLLECTED_TOTAL_ID } from '@tests/utils/testIDs';
import {
  AllRootProvidersWrapper,
  renderWithUser,
  renderWithWrapper,
} from '@tests/utils/wrappers';
import { baseAuthContextValues } from '@tests/utils/basicMockupValues';

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
  it('Testing proper rendering when superadmin is logged in', ({ expect }) => {
    const { getByTestId, getByText } = renderWithWrapper(
      <HomePage />,
      AllRootProvidersWrapper(),
    );
    expect(getByText('Wydaj puszkę wolontariuszowi')).toBeInTheDocument();
    expect(getByText('Rozlicz puszkę')).toBeInTheDocument();
    expect(getByTestId('collected-pln-test-id')).toBeInTheDocument();
    expect(getByTestId('collected-total-test-id')).toBeInTheDocument();
  });

  it('Testing proper rendering when wosp01 is logged in', ({ expect }) => {
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

  it("Test clicking 'Wydaj puszkę wolontariuszowi' link", async ({ expect }) => {
    const { getByText, user } = renderWithUser(<HomePage />, AllRootProvidersWrapper());
    const button = getByText('Wydaj puszkę wolontariuszowi');
    await user.click(button);
    expect(window.location.pathname).toBe('/boxes');
  });

  it("Test clicking 'Rozlicz puszkę' link", async ({ expect }) => {
    const { getByText, user } = renderWithUser(<HomePage />, AllRootProvidersWrapper());
    const button = getByText('Rozlicz puszkę');
    await user.click(button);
    await waitFor(() => expect(window.location.pathname).toBe('/boxes/settle'));
  });

  it('Test displaying data returned from API', async ({ expect }) => {
    const { getByText } = renderWithWrapper(<HomePage />, AllRootProvidersWrapper());
    await waitFor(() => expect(getByText('100 zł')).toBeInTheDocument());
    await waitFor(() => expect(getByText('200 zł')).toBeInTheDocument());
  });
});
