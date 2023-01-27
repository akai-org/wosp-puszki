import s from './MoneyDisplay.module.less';
import { Logos } from '@components/Display/MoneyDisplay/Logos/Logos';
import { Currencies } from '@components/Display/MoneyDisplay/Currencies/Currencies';
import { BottomContent } from '@components/Display/MoneyDisplay/BottomContent/BottomContent';

export const MoneyDisplay = () => {
  return (
    <section className={s.moneyDataContainer}>
      <section className={s.upperContent}>
        <Logos />
        <Currencies />
      </section>
      <BottomContent />
    </section>
  );
};
