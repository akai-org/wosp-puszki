import s from './MoneyDisplay.module.less';
import { FC } from 'react';
import { Logos } from '@components/Display/MoneyDisplay/Logos/Logos';
import { Currencies } from '@components/Display/MoneyDisplay/Currencies/Currencies';
import { BottomContent } from '@components/Display/MoneyDisplay/BottomContent/BottomContent';

interface Props {
  collectedMoney: string;
}

export const MoneyDisplay: FC<Props> = ({ collectedMoney }) => {
  return (
    <section className={s.moneyDataContainer}>
      <Logos />
      <Currencies collectedMoney={collectedMoney} />
      <BottomContent />
    </section>
  );
};
