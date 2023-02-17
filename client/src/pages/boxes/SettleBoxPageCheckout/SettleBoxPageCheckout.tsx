import s from './SettleBoxPageCheckout.module.less';
import { Button } from 'antd';
import { useDepositContext } from '@/utils/Contexts/DepositContext';
import { useNavigate } from 'react-router-dom';
import {
  APIManager,
  fetcher,
  useBoxContext,
  setStationUnavailable,
  MONEY_VALUES,
  isFailedFetched,
  openNotification,
  NO_CONNECT_WITH_SERVER,
} from '@/utils';
import { useMutation } from '@tanstack/react-query';

import { Spinner } from '@components/Layout/Spinner/Spinner';

export const SettleBoxPageCheckout = () => {
  const navigate = useNavigate();
  const { boxData, zlotySum, cleanAmounts } = useDepositContext();
  const { isBoxExists, deleteBox, boxIdentifier, collectorIdentifier } = useBoxContext();

  if (!isBoxExists()) {
    navigate('/liczymy/boxes/settle');
  }

  setStationUnavailable();

  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}/finishCounting`, {
        method: 'POST',
      }),
    onSuccess: () => {
      deleteBox();
      cleanAmounts();
      navigate('/liczymy/boxes/settle');
    },
    onError: (error) => {
      if (isFailedFetched(error)) openNotification('error', NO_CONNECT_WITH_SERVER);
    },
  });

  const goBackToDeposit = () => {
    navigate(-2);
  };

  const confirmData = () => {
    mutation.mutate();
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
                  {boxData.amounts.count_1gr * MONEY_VALUES['1gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>2gr</td>
                <td className={s.middle}>{boxData.amounts.count_2gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_2gr * MONEY_VALUES['2gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>5gr</td>
                <td className={s.middle}>{boxData.amounts.count_5gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_5gr * MONEY_VALUES['5gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>10gr</td>
                <td className={s.middle}>{boxData.amounts.count_10gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_10gr * MONEY_VALUES['10gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>20gr</td>
                <td className={s.middle}>{boxData.amounts.count_20gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_20gr * MONEY_VALUES['20gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>50gr</td>
                <td className={s.middle}>{boxData.amounts.count_50gr}</td>
                <td className={s.right}>
                  {boxData.amounts.count_50gr * MONEY_VALUES['50gr']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>1zl</td>
                <td className={s.middle}>{boxData.amounts.count_1zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_1zl * MONEY_VALUES['1zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>2zl</td>
                <td className={s.middle}>{boxData.amounts.count_2zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_2zl * MONEY_VALUES['2zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>5zl</td>
                <td className={s.middle}>{boxData.amounts.count_5zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_5zl * MONEY_VALUES['5zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>10zl</td>
                <td className={s.middle}>{boxData.amounts.count_10zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_10zl * MONEY_VALUES['10zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>20zl</td>
                <td className={s.middle}>{boxData.amounts.count_20zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_20zl * MONEY_VALUES['20zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>50zl</td>
                <td className={s.middle}>{boxData.amounts.count_50zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_50zl * MONEY_VALUES['50zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>100zl</td>
                <td className={s.middle}>{boxData.amounts.count_100zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_100zl * MONEY_VALUES['100zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>200zl</td>
                <td className={s.middle}>{boxData.amounts.count_200zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_200zl * MONEY_VALUES['200zl']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>500zl</td>
                <td className={s.middle}>{boxData.amounts.count_500zl}</td>
                <td className={s.right}>
                  {boxData.amounts.count_500zl * MONEY_VALUES['500zl']}
                </td>
              </tr>
            </tbody>

            <tfoot>
              <tr>
                <td className={s.left}>Suma (PLN)</td>
                <td></td>
                <td className={s.right}>{zlotySum} zł</td>
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
                  {boxData.amounts.amount_EUR * MONEY_VALUES['EUR']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>GBP</td>
                <td className={s.right}>
                  {boxData.amounts.amount_GBP * MONEY_VALUES['GBP']}
                </td>
              </tr>
            </tbody>
            <tbody>
              <tr>
                <td className={s.left}>USD</td>
                <td className={s.right}>
                  {boxData.amounts.amount_USD * MONEY_VALUES['USD']}
                </td>
              </tr>
            </tbody>
          </table>
          <p className={s.otherTitleParagraph}>Inne</p>
          <p className={s.otherContentParagraph}>{boxData.comment}</p>
        </div>

        <div className={s.sum}>
          <h4>Suma (bez walut obcych):</h4>
          <h4>{zlotySum} zł</h4>
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
