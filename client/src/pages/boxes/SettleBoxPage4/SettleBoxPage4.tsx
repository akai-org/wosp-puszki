import { Item } from 'rc-menu';
import s from '../BoxesPage.module.less';
import { Button } from 'antd';

interface BoxData {
  volunteerId: string;
  boxId: string;
  plnAmount: Record<string, number>;
  foreignCurrency: Record<string, number>;
  other?: string;
}

export const SettleBoxPage4 = () => {
  const data = {
    volunteerId: 123,
    boxId: 22,
    plnAmount: [
      {
        name: '1gr',
        quantity: 2,
        multiplier: 0.01,
      },
      {
        name: '2gr',
        quantity: 0,
        multiplier: 0.02,
      },
      {
        name: '5gr',
        quantity: 0,
        multiplier: 0.05,
      },
      {
        name: '10gr',
        quantity: 0,
        multiplier: 0.1,
      },
      {
        name: '20gr',
        quantity: 0,
        multiplier: 0.2,
      },
      {
        name: '50gr',
        quantity: 0,
        multiplier: 0.5,
      },
      {
        name: '1zł',
        quantity: 4,
        multiplier: 1,
      },
      {
        name: '2zł',
        quantity: 0,
        multiplier: 2,
      },
      {
        name: '5zł',
        quantity: 0,
        multiplier: 5,
      },
      {
        name: '10zł',
        quantity: 0,
        multiplier: 10,
      },
      {
        name: '20zł',
        quantity: 0,
        multiplier: 20,
      },
      {
        name: '50zł',
        quantity: 0,
        multiplier: 50,
      },
      {
        name: '100zł',
        quantity: 0,
        multiplier: 100,
      },
      {
        name: '200zł',
        quantity: 3,
        multiplier: 200,
      },
      {
        name: '500zł',
        quantity: 0,
        multiplier: 500,
      },
    ],
    foreignCurrency: [
      {
        name: 'Euro (EUR)',
        amount: 52,
      },
      {
        name: 'Funt brytyjski (GBP)',
        amount: 5,
      },
      {
        name: 'Dolar amerykański (USD)',
        amount: 100,
      },
    ],
    others:
      'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
  };

  let totalPLNSum = 0;

  return (
    <div className={s.page4}>
      <h3>
        Potwierdzenie rozliczenia puszki wolontariusza {data.volunteerId} (ID puszki w
        bazie:
        {data.boxId})
      </h3>
      <div className={s.content}>
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
          <p className={s.otherParagraph}>Inne</p>
          <p className={s.otherParagraph2}>{data.others}</p>
        </div>
        <div className={s.sum}>
          <h4>Suma (bez walut obcych):</h4>
          <h4>{totalPLNSum} zł</h4>
        </div>
      </div>
      <div className={s.action}>
        <p>Nie wydaj puszki wolontariusz</p>
        <Button className={s.confirm}>Potwierdź rozliczenie puszki</Button>
        <Button className={s.goBack}>Wróć do poprzedniej strony</Button>
      </div>
    </div>
  );
};
