import collected from '@assets/collected-text.svg';
import { Space, Typography } from 'antd';
import s from './Currencies.module.less';
import { FC } from 'react';

interface Props {
  collectedMoney: string;
}

export const Currencies: FC<Props> = ({ collectedMoney }) => {
  return (
    <>
      <img height={80} src={collected} alt="" />
      <Typography.Title className={s.collectedText}>
        <span>{collectedMoney}</span>
        zł
      </Typography.Title>
      <Space className={s.currencies}>
        <Typography.Paragraph>
          <span>45 140,72 </span>
          zł
        </Typography.Paragraph>
        <Typography.Paragraph>
          <span>52,82 </span>€
        </Typography.Paragraph>
        <Typography.Paragraph>
          <span>44,79 </span>£
        </Typography.Paragraph>
        <Typography.Paragraph>
          <span>45,70 </span>$
        </Typography.Paragraph>
      </Space>
    </>
  );
};
