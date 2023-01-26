import collected from '@assets/collected-text.svg';
import { Space, Typography } from 'antd';
import s from './Currencies.module.less';
import { FC } from 'react';
import { currencies, parseMoney } from '@/utils';
import { Amounts } from '@pages/DisplayPage';

interface Props {
  amounts: Amounts;
}

export const Currencies: FC<Props> = ({ amounts }) => {
  const collectedCurrencies: Record<currencies, string> = {
    pln: parseMoney(amounts.pln, 'pln'),
    usd: parseMoney(amounts.dollar, 'usd'),
    eur: parseMoney(amounts.euro, 'eur'),
    gbp: parseMoney(amounts.pound, 'gbp'),
  };

  return (
    <>
      <img height={80} src={collected} alt="" className={s.collectedImage} />
      <Typography.Title className={s.collectedText}>
        {parseMoney(amounts.total, 'pln')}
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
