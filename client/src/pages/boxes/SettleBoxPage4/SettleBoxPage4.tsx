import { Item } from 'rc-menu';
import s from '../BoxesPage.module.less';

interface Dupa {
  id: string;
  boxId: string;
  plnAmount: Record<string, number>;
  foreignCurrency: Record<string, number>;
  other?: string;
}

export const SettleBoxPage4 = () => {
  const data = {
    volunteerId: 123,
    boxId: 22,
    plnAmount: {
      // [{
      //   name: '1gr'
      //   quantity: 3;
      //   multiplier: 0.01
      //   sum: 0;
      // } sum += Item.sum]

      '2gr': 0,
      '5gr': 0,
      '10gr': 4,
      '20gr': 0,
      '50gr': 0,
      '1zł': 0,
      '2zł': 0,
      '5zł': 0,
      '10zł': 0,
      '20zł': 5,
      '50zł': 0,
      '100zł': 0,
      '200zł': 0,
      '500zł': 2,
    },
    foreignCurrency: {
      EUR: 0,
      GBP: 0,
      USD: 0,
    },
    others:
      'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
  };

  return (
    <div className={s.page4}>
      <h3>
        Potwierdzenie rozliczenia puszki wolontariusza {data.volunteerId} (ID puszki w
        bazie:
        {data.boxId})
      </h3>
      <div className={s.content}>
        <div className={s.table}>
          <table>
            <tr>
              <th>Nominał</th>
              <th>Ilość</th>
              <th>Wartość</th>
            </tr>
            <tr>
              <td>1gr</td>
              <td>{data.plnAmount['1gr']}</td>
              <td>{+data.plnAmount['1gr'] * 0.01} zł</td>
            </tr>
            <tr>
              <td>2gr</td>
              <td>{data.plnAmount['2gr']}</td>
              <td>{+data.plnAmount['2gr'] * 0.02} zł</td>
            </tr>
            <tr>
              <td>5gr</td>
              <td>{data.plnAmount['5gr']}</td>
              <td>{+data.plnAmount['5gr'] * 0.05} zł</td>
            </tr>
            <tr>
              <td>10gr</td>
              <td>{data.plnAmount['10gr']}</td>
              <td>{+data.plnAmount['10gr'] * 0.1} zł</td>
            </tr>
            <tr>
              <td>20gr</td>
              <td>{data.plnAmount['20gr']}</td>
              <td>{+data.plnAmount['20gr'] * 0.2} zł</td>
            </tr>
            <tr>
              <td>50gr</td>
              <td>{data.plnAmount['50gr']}</td>
              <td>{+data.plnAmount['50gr'] * 0.5} zł</td>
            </tr>
            <tr>
              <td>1zł</td>
              <td>{data.plnAmount['1zł']}</td>
              <td>{+data.plnAmount['1zł'] * 1} zł</td>
            </tr>
            <tr>
              <td>2zł</td>
              <td>{data.plnAmount['2zł']}</td>
              <td>{+data.plnAmount['2zł'] * 2} zł</td>
            </tr>
            <tr>
              <td>5zł</td>
              <td>{data.plnAmount['5zł']}</td>
              <td>{+data.plnAmount['5zł'] * 5} zł</td>
            </tr>
            <tr>
              <td>10zł</td>
              <td>{data.plnAmount['10zł']}</td>
              <td>{+data.plnAmount['10zł'] * 10} zł</td>
            </tr>
            <tr>
              <td>20zł</td>
              <td>{data.plnAmount['20zł']}</td>
              <td>{+data.plnAmount['20zł'] * 20} zł</td>
            </tr>
            <tr>
              <td>50zł</td>
              <td>{data.plnAmount['50zł']}</td>
              <td>{+data.plnAmount['50zł'] * 50} zł</td>
            </tr>
            <tr>
              <td>100zł</td>
              <td>{data.plnAmount['100zł']}</td>
              <td>{+data.plnAmount['100zł'] * 100} zł</td>
            </tr>
            <tr>
              <td>200zł</td>
              <td>{data.plnAmount['200zł']}</td>
              <td>{+data.plnAmount['200zł'] * 200} zł</td>
            </tr>
            <tr>
              <td>500zł</td>
              <td>{data.plnAmount['500zł']}</td>
              <td>{+data.plnAmount['500zł'] * 500} zł</td>
            </tr>
          </table>
        </div>
        <div>Other</div>
        <div>sum</div>
      </div>
      <div className={s.action}>action</div>
    </div>
  );
};
