import {
  APIManager,
  AmountsKeys,
  DEPOSIT_BOX_PAGE_ROUTE,
  MONEY_AMOUNTS_VALUES,
  MONEY_VALUES,
  SETTLE_PROCESS_PATH,
  ZLOTY_AMOUNTS_KEYS,
  createFullRoutePath,
  sum,
} from '@/utils';
import { screen, waitFor } from '@testing-library/react';
import {
  baseAuthContextValues,
  baseBoxContextValues,
  baseDepositContextValues,
} from '@tests/utils/basicMockupValues';
import { SettleBoxProvidersWrapper, renderWithWrapper } from '@tests/utils/wrappers';
import { SettleBoxPageCheckout } from './SettleBoxPageCheckout';
import { mockEndpoint } from '@tests/utils/MSWSetup';
import { act } from 'react-dom/test-utils';

const testData = {
  amounts: {
    count_1gr: 2,
    count_2gr: 1,
    count_5gr: 1,
    count_10gr: 1,
    count_20gr: 1,
    count_50gr: 1,
    count_1zl: 1,
    count_2zl: 1,
    count_5zl: 1,
    count_10zl: 1,
    count_20zl: 1,
    count_50zl: 1,
    count_100zl: 1,
    count_200zl: 1,
    count_500zl: 1,
    amount_EUR: 1,
    amount_USD: 1,
    amount_GBP: 1,
  },
  comment: '',
};

beforeEach(() => {
  renderWithWrapper(
    <SettleBoxPageCheckout />,
    SettleBoxProvidersWrapper({
      depositContextValues: () => ({
        ...baseDepositContextValues,
        boxData: testData,
      }),
      boxContextValues: () => ({ ...baseBoxContextValues }),
      authContextValues: () => ({ ...baseAuthContextValues }),
    }),
  );
});

describe('Settle Box Page Checkout render correctly', () => {
  it('Should render all lines on the page', () => {
    const KeyItem = screen.getAllByTestId('columnLine');
    expect(KeyItem).toHaveLength(Object.keys(MONEY_AMOUNTS_VALUES).length);
  });

  describe('All info renders correctly', () => {
    describe('Denomination render correctly', () => {
      it('Should render all denomination on the page', () => {
        for (const denomination of Object.values(MONEY_AMOUNTS_VALUES)) {
          const Denomination = screen.getByText(denomination);
          expect(Denomination).toBeInTheDocument();
        }
      });
    });

    describe('Amounts render correctly', () => {
      it('Should render all amounts on the page', () => {
        for (const amount of Object.keys(MONEY_AMOUNTS_VALUES)) {
          const AmountItem = screen.getByTestId(`amount,${amount}`);
          expect(AmountItem).toBeInTheDocument();
          const AmountItemText = screen.getByTestId(`amount,${amount}`);
          expect(AmountItemText).toHaveTextContent(
            `${testData.amounts[amount as AmountsKeys]}`,
          );
        }
      });
    });

    describe('Values render correctly', () => {
      it('Should render zloty values on the page', () => {
        for (const amount of ZLOTY_AMOUNTS_KEYS) {
          const AmountItem = screen.getByTestId(`value,${amount}`);
          expect(AmountItem).toHaveTextContent(
            testData.amounts[amount] *
              MONEY_VALUES[MONEY_AMOUNTS_VALUES[amount] as keyof typeof MONEY_VALUES] +
              ' zł',
          );
        }
      });

      describe('should show correct value of sum in two places', () => {
        it('Show sum under lines', () => {
          const total = screen.getByTestId('sm_total');
          expect(total).toHaveTextContent(
            `${sum(testData, ZLOTY_AMOUNTS_KEYS, MONEY_VALUES)} zł`,
          );
        });

        it('Show sum next to columns', () => {
          const total = screen.getByTestId('total');
          expect(total).toHaveTextContent(
            `${sum(testData, ZLOTY_AMOUNTS_KEYS, MONEY_VALUES)} zł`,
          );
        });
      });
    });
  });
});

describe('Settle Box Page Checkout work correctly', () => {
  it('Should can go back to previous page', () => {
    const BackButton = screen.getByTestId('backButton');

    act(() => BackButton.click());

    expect(window.location.pathname).toBe(
      createFullRoutePath(SETTLE_PROCESS_PATH, DEPOSIT_BOX_PAGE_ROUTE),
    );
  });

  it('Should go to the start of settle process after success submiting', async () => {
    const SubmitButton = screen.getByTestId('submitButton');

    act(() => SubmitButton.click());

    mockEndpoint(
      `${APIManager.baseAPIRUrl}/boxes/${baseBoxContextValues.boxIdentifier}/finishCounting`,
      {
        httpVerb: 'post',
        status: 200,
      },
    );

    await waitFor(() => {
      expect(window.location.pathname).toBe(SETTLE_PROCESS_PATH);
    });
  });
});
