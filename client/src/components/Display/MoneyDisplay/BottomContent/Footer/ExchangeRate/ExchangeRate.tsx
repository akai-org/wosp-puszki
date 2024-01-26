import { FC } from 'react';
import s from './ExchangeRate.module.less';
import { parseMoney } from '@/utils';

interface Props {
  exchangeName: baseExchangeName;
  exchangeRate: number;
}

type baseExchangeValue = '€' | '$' | '£';
type baseExchangeName = 'eur' | 'usd' | 'gbp';

const exchangeRateValues: Record<baseExchangeName, baseExchangeValue> = {
  usd: '$',
  eur: '€',
  gbp: '£',
};

export const ExchangeRate: FC<Props> = ({ exchangeRate, exchangeName }) => {
  return (
    <div className={s.exchangeRate}>
      1{exchangeRateValues[exchangeName]} <span className={s.arrowMargin}>→</span>{' '}
      {parseMoney(exchangeRate, 'pln')}
    </div>
  );
};
