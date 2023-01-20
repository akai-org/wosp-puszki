import { FC } from 'react';
import s from './ExchangeRate.module.less';

interface Props {
  exchangeName: baseExchangeName;
  exchangeRate: number;
}

type baseExchangeValue = '€' | '$' | '£';
type baseExchangeName = 'euro' | 'dollar' | 'pound';

export const ExchangeRate: FC<Props> = ({ exchangeRate, exchangeName }) => {
  const exchangeRateValues: Record<baseExchangeName, baseExchangeValue> = {
    dollar: '$',
    euro: '€',
    pound: '£',
  };

  return (
    <div className={s.exchangeRate}>
      1{exchangeRateValues[exchangeName]} → {exchangeRate}
      zł
    </div>
  );
};
