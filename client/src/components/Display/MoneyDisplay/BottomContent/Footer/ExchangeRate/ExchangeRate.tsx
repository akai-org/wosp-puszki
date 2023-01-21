import { FC } from 'react';
import s from './ExchangeRate.module.less';
import { parseMoney } from '@/utils';

interface Props {
  exchangeName: baseExchangeName;
  exchangeRate: number;
}

type baseExchangeValue = '€' | '$' | '£';
type baseExchangeName = 'eur' | 'usd' | 'gbp';

export const ExchangeRate: FC<Props> = ({ exchangeRate, exchangeName }) => {
  const exchangeRateValues: Record<baseExchangeName, baseExchangeValue> = {
    usd: '$',
    eur: '€',
    gbp: '£',
  };

  return (
    <div className={s.exchangeRate}>
      1{exchangeRateValues[exchangeName]} → {parseMoney(exchangeRate, 'pln')}
    </div>
  );
};
