import s from '../BoxesPage.module.less';

export const SettleBoxPage4 = () => {
  const data = {
    volunteerId: 123,
    boxId: 22,
    plnAmount: {
      '1gr': 0,
      '2gr': 0,
      '5gr': 0,
      '10gr': 0,
      '20gr': 0,
      '50gr': 0,
      '1zł': 0,
      '2zł': 0,
      '5zł': 0,
      '10zł': 0,
      '20zł': 0,
      '50zł': 0,
      '100zł': 0,
      '200zł': 0,
      '500zł': 0,
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
        <div>PLN</div>
        <div>Other</div>
        <div>sum</div>
      </div>
      <div className={s.action}>action</div>
    </div>
  );
};
