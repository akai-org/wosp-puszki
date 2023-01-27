import collected from '@assets/collected-text.svg';
import eskarbonka from '@assets/eskarbonka.svg';
import { Space, Typography } from 'antd';
import s from './Currencies.module.less';
import { currencies, parseMoney, useAmountsQuery } from '@/utils';

export const Currencies = () => {
  const { data } = useAmountsQuery();
  console.log(data);

  const collectedCurrencies: Record<currencies, string> = {
    pln: parseMoney(data.amount_PLN, 'pln'),
    usd: parseMoney(data.amount_USD, 'usd'),
    eur: parseMoney(data.amount_EUR, 'eur'),
    gbp: parseMoney(data.amount_GBP, 'gbp'),
  };

  return (
    <>
      <img height={80} src={collected} alt="" className={s.collectedImage} />
      <Typography.Title className={s.collectedText}>
        {parseMoney(data.amount_total_in_PLN, 'pln')}
      </Typography.Title>
      <Space className={s.currencies}>
        <Typography.Paragraph>{collectedCurrencies.pln}</Typography.Paragraph>
        <Typography.Paragraph>{collectedCurrencies.eur}</Typography.Paragraph>
        <Typography.Paragraph>{collectedCurrencies.gbp}</Typography.Paragraph>
        <Typography.Paragraph>{collectedCurrencies.usd}</Typography.Paragraph>
      </Space>
      <Space className={s.eBox}>
        <img height={80} src={eskarbonka} alt="" />
        <Typography.Paragraph>
          {parseMoney(data.amount_PLN_eskarbonka, 'pln')}
        </Typography.Paragraph>
      </Space>
    </>
  );
};
