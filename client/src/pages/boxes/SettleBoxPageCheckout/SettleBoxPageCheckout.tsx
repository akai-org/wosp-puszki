import s from './SettleBoxPageCheckout.module.less';
import { Button } from 'antd';
import { useContext } from 'react';
import { DepositContext } from '@/components/forms/DepositBoxForm/DepositContext';
import { useNavigate } from 'react-router-dom';
type denomination =
  | '1gr'
  | '2gr'
  | '5gr'
  | '10gr'
  | '20gr'
  | '50gr'
  | '1zł'
  | '2zł'
  | '5zł'
  | '10zł'
  | '20zł'
  | '50zł'
  | '100zł'
  | '200zł'
  | '500zł';

interface BoxData {
  volunteerId: number;
  boxId: number;
  plnAmount: Array<{
    name: denomination;
    quantity: number;
    multiplier: number;
  }>;
  foreignCurrency: Array<{
    name: string;
    amount: number;
  }>;
  others?: string;
}

export const SettleBoxPageCheckout = () => {
  const { data } = useContext(DepositContext);
  const navigate = useNavigate();
  let totalPLNSum = 0;

  const goBackToDeposit = () => {
    navigate(-2);
  };

  return (
    <div className={s.pageCheckout}>
      <h3>
        Potwierdzenie rozliczenia puszki wolontariusza {data.volunteerId} (ID puszki w
        bazie:
        {data.boxId})
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
            {data.plnAmount.map((val, key) => {
              totalPLNSum += val.quantity * val.multiplier;
              return (
                <tbody key={key}>
                  <tr>
                    <td className={s.left}>{val.name}</td>
                    <td className={s.middle}>{val.quantity}</td>
                    <td className={s.right}>{val.quantity * val.multiplier}</td>
                  </tr>
                </tbody>
              );
            })}
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
            {data.foreignCurrency.map((val, key) => {
              return (
                <tbody key={key}>
                  <tr>
                    <td className={s.left}>{val.name}</td>
                    <td className={s.right}>{val.amount}</td>
                  </tr>
                </tbody>
              );
            })}
          </table>
          <p className={s.otherTitleParagraph}>Inne</p>
          <p className={s.otherContentParagraph}>{data.others}</p>
        </div>
        <div className={s.sum}>
          <h4>Suma (bez walut obcych):</h4>
          <h4>{totalPLNSum} zł</h4>
        </div>
      </div>
      <div className={s.action}>
        <p>Nie wydawaj puszki wolontariuszowi</p>
        <Button className={s.confirm}>Potwierdź rozliczenie puszki</Button>
        <Button className={s.goBack} onClick={goBackToDeposit}>
          Wróć do poprzedniej strony
        </Button>
      </div>
    </div>
  );
};
