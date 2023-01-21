import s from './Footer.module.less';
import { Space } from 'antd';
import { ExchangeRate } from '@components/Display/MoneyDisplay/BottomContent/Footer/ExchangeRate/ExchangeRate';

export const Footer = () => {
  return (
    <Space direction="vertical" className={s.footer}>
      <Space align="center">
        © 2017-2023
        <a href="http://wosp.put.poznan.pl/">SZTAB WOŚP PRZY POLITECHNICE POZNAŃSKIEJ</a>I
        <a href="https://akai.org.pl/">AKAI</a>
      </Space>
      <Space className={s.exchangeRate}>
        kursy: <ExchangeRate exchangeName="eur" exchangeRate={5.1345} /> |
        <ExchangeRate exchangeName="usd" exchangeRate={4.3215} /> |
        <ExchangeRate exchangeName="gbp" exchangeRate={6.4367} />
      </Space>
    </Space>
  );
};
