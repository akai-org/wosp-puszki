import collected from '@assets/collected-text.svg';
import { Space, Typography } from 'antd';
import s from './Currencies.module.less';
import { FC } from 'react';
import { currencies, parseMoney } from '@/utils';

interface Props {
  collectedMoney: number;
}

export const Currencies: FC<Props> = ({ collectedMoney }) => {
  const collectedCurrencies: Record<currencies, string> = {
    pln: parseMoney(234.96, 'pln'),
    usd: parseMoney(2137.54, 'usd'),
    eur: parseMoney(420.5, 'eur'),
    gbp: parseMoney(1701.0, 'gbp'),
  };

  return (
    <>
      <img height={80} src={collected} alt="" className={s.collectedImage} />
      <Typography.Title className={s.collectedText}>
        {parseMoney(collectedMoney, 'pln')}
      </Typography.Title>
      <Space className={s.currencies}>
        <Typography.Paragraph>{collectedCurrencies.pln}</Typography.Paragraph>
        <Typography.Paragraph>{collectedCurrencies.eur}</Typography.Paragraph>
        <Typography.Paragraph>{collectedCurrencies.gbp}</Typography.Paragraph>
        <Typography.Paragraph>{collectedCurrencies.usd}</Typography.Paragraph>
      </Space>
    </>
  );
};
