import s from './MoneyDisplay.module.less';
import { FC } from 'react';
import { Logos } from '@components/Display/MoneyDisplay/Logos/Logos';
import { Currencies } from '@components/Display/MoneyDisplay/Currencies/Currencies';
import { BottomContent } from '@components/Display/MoneyDisplay/BottomContent/BottomContent';
import { Amounts, ExchangeRates } from '@pages/DisplayPage';

interface Props {
  amounts: Amounts;
  availableStations: number;
  volunteersAmount: number;
  exchangeRates: ExchangeRates;
}

export const MoneyDisplay: FC<Props> = ({
  amounts,
  volunteersAmount,
  availableStations,
  exchangeRates,
}) => {
  return (
    <section className={s.moneyDataContainer}>
      <section className={s.upperContent}>
        <Logos />
        <Currencies amounts={amounts} />
      </section>
      <BottomContent
        exchangeRates={exchangeRates}
        availableStations={availableStations}
        volunteersAmount={volunteersAmount}
      />
    </section>
  );
};
