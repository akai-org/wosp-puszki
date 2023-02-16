import s from './SettleBoxPageCheckout.module.less';
import { Button, Space } from 'antd';
import { useDepositContext } from '@/components/forms/DepositBoxForm/DepositContext';
import { useNavigate } from 'react-router-dom';
import {
  AmountsKeys,
  APIManager,
  fetcher,
  useAuthContext,
  useBoxContext,
  useBoxContextValues,
  useSetStationUnavailableQuery,
} from '@/utils';
import { useMutation } from '@tanstack/react-query';

import { Spinner } from '@components/Layout/Spinner/Spinner';
import { useEffect } from 'react';

const moneyValues = {
  '1gr': 0.01,
  '2gr': 0.02,
  '5gr': 0.05,
  '10gr': 0.1,
  '20gr': 0.2,
  '50gr': 0.5,
  '1zl': 1,
  '2zl': 2,
  '5zl': 5,
  '10zl': 10,
  '20zl': 20,
  '50zl': 50,
  '100zl': 100,
  '200zl': 200,
  '500zl': 500,
  EUR: 4.71,
  GBP: 5.37,
  USD: 4.33,
};

export function sum(amounts: Record<AmountsKeys, number>) {
  let sum = 0;
  for (const key in amounts) {
    const moneyDen = key.split('_')[1];
    sum +=
      amounts[key as AmountsKeys] * moneyValues[moneyDen as keyof typeof moneyValues];
  }
  return sum;
}

export const SettleBoxPageCheckout = () => {
  const { boxData } = useDepositContext();
  const { collectorIdentifier, boxIdentifier } = useBoxContext();
  const { deleteBox } = useBoxContextValues();

  const navigate = useNavigate();

  useEffect(() => {
    if (collectorIdentifier === null || boxIdentifier === null) {
      navigate('/liczymy/boxes/settle');
    }
  }, [boxIdentifier, collectorIdentifier]);

  const totalPLNSum = sum(boxData.amounts);
  const { username } = useAuthContext();
  useSetStationUnavailableQuery(username);
  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}/finishCounting`, {
        method: 'POST',
      }),
    onSuccess: () => navigate('/liczymy/boxes/settle'),
  });

  const goBackToDeposit = () => {
    navigate(-2);
  };

  const confirmData = () => {
    mutation.mutate();
    deleteBox();
  };

  return (
    <div className={s.pageCheckout}>
      <h3>
        Potwierdzenie rozliczenia puszki wolontariusza {collectorIdentifier} (ID puszki w
        bazie:
        {boxIdentifier})
      </h3>
      <div className={s.contentTable}>
        <div>
          <table className={s.table}>
            <thead>
              <tr>
                <th className={s.left}>Nominał</th>
                <th className={s.middle}>Ilość</th>
                <th className={s.right}>Wartość</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td className={s.left}>1gr</td>
                <td className={s.middle}>{boxData.amounts.count_1gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_1gr * moneyValues['1gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>2gr</td>
                <td className={s.middle}>{boxData.amounts.count_2gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_2gr * moneyValues['2gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>5gr</td>
                <td className={s.middle}>{boxData.amounts.count_5gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_5gr * moneyValues['5gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>10gr</td>
                <td className={s.middle}>{boxData.amounts.count_10gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_10gr * moneyValues['10gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>20gr</td>
                <td className={s.middle}>{boxData.amounts.count_20gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_20gr * moneyValues['20gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>50gr</td>
                <td className={s.middle}>{boxData.amounts.count_50gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_50gr * moneyValues['50gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>1zl</td>
                <td className={s.middle}>{boxData.amounts.count_1zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_1zl * moneyValues['1zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>2zl</td>
                <td className={s.middle}>{boxData.amounts.count_2zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_2zl * moneyValues['2zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>5zl</td>
                <td className={s.middle}>{boxData.amounts.count_5zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_5zl * moneyValues['5zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>10zl</td>
                <td className={s.middle}>{boxData.amounts.count_10zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_10zl * moneyValues['10zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>20zl</td>
                <td className={s.middle}>{boxData.amounts.count_20zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_20zl * moneyValues['20zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>50zl</td>
                <td className={s.middle}>{boxData.amounts.count_50zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_50zl * moneyValues['50zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>100zl</td>
                <td className={s.middle}>{boxData.amounts.count_100zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_100zl * moneyValues['100zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>200zl</td>
                <td className={s.middle}>{boxData.amounts.count_200zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_200zl * moneyValues['200zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>500zl</td>
                <td className={s.middle}>{boxData.amounts.count_500zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_500zl * moneyValues['500zl']}
                </td>
              </tr>
            </tbody>

            <tfoot>
              <tr>
                <td className={s.left}>Suma (PLN)</td>
                <td></td>
                <td className={s.right}>{totalPLNSum} zł</td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div>
          <table className={s.table}>
            <thead>
              <tr>
                <th className={s.left}>Waluta</th>
                <th className={s.right}>Ilość</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td className={s.left}>Euro</td>
                <td className={s.right}>
                  {boxData.amounts.amount_EUR * moneyValues['EUR']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>GBP</td>
                <td className={s.right}>
                  {boxData.amounts.amount_GBP * moneyValues['GBP']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>USD</td>
                <td className={s.right}>
                  {boxData.amounts.amount_USD * moneyValues['USD']}
                </td>
              </tr>
            </tbody>
          </table>
          <p className={s.otherTitleParagraph}>Inne</p>
          <p className={s.otherContentParagraph}>{boxData.comment}</p>
        </div>

        <div className={s.sum}>
          <h4>Suma (bez walut obcych):</h4>
          <h4>{totalPLNSum} zł</h4>
          <div className={s.action}>
            <p>Nie wydawaj puszki wolontariuszowi</p>
            <Button className={s.confirm} onClick={confirmData}>
              {mutation.isLoading ? <Spinner /> : 'Potwierdź rozliczenie puszki'}
            </Button>
            <Button className={s.goBack} onClick={goBackToDeposit}>
              Wróć do poprzedniej strony
            </Button>
          </div>
        </div>
      </div>
    </div>
  );
};
