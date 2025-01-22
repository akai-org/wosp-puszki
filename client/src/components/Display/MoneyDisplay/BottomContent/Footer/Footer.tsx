import s from './Footer.module.less';
import { Space } from 'antd';
import { ExchangeRate } from '@components/Display/MoneyDisplay/BottomContent/Footer/ExchangeRate/ExchangeRate';
import { FC } from 'react';
import { ExchangeRates } from '@/utils';

interface Props {
  exchangeRates: ExchangeRates;
}
export const Footer: FC<Props> = ({ exchangeRates }) => {
  return (
    <Space direction="vertical" className={s.footer}>
      <Space align="center">
        © 2017-2025
        <a id="rescale" href="http://wosp.put.poznan.pl/">
          SZTAB WOŚP PRZY POLITECHNICE POZNAŃSKIEJ
        </a>
        I
        <a id="rescale" href="https://akai.org.pl/">
          AKAI
        </a>
      </Space>
      <Space id="rescale" className={s.exchangeRate}>
        kursy: <ExchangeRate exchangeName="eur" exchangeRate={exchangeRates.EUR} /> |
        <ExchangeRate exchangeName="usd" exchangeRate={exchangeRates.USD} /> |
        <ExchangeRate exchangeName="gbp" exchangeRate={exchangeRates.GBP} />
      </Space>
    </Space>
  );
};
