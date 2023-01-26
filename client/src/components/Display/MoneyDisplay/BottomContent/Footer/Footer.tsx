import s from './Footer.module.less';
import { Space } from 'antd';
import { ExchangeRate } from '@components/Display/MoneyDisplay/BottomContent/Footer/ExchangeRate/ExchangeRate';
import { ExchangeRates } from '@pages/DisplayPage';
import { FC } from 'react';

interface Props {
  exchangeRates: ExchangeRates;
}
export const Footer: FC<Props> = ({ exchangeRates }) => {
  return (
    <Space direction="vertical" className={s.footer}>
      <Space align="center">
        © 2017-2023
        <a href="http://wosp.put.poznan.pl/">SZTAB WOŚP PRZY POLITECHNICE POZNAŃSKIEJ</a>I
        <a href="https://akai.org.pl/">AKAI</a>
      </Space>
      <Space className={s.exchangeRate}>
        kursy: <ExchangeRate exchangeName="eur" exchangeRate={exchangeRates.euro} /> |
        <ExchangeRate exchangeName="usd" exchangeRate={exchangeRates.dollar} /> |
        <ExchangeRate exchangeName="gbp" exchangeRate={exchangeRates.pound} />
      </Space>
    </Space>
  );
};
