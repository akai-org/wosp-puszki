import { Space, Typography } from 'antd';
import { FC } from 'react';
import s from './Line.module.less';
const { Text } = Typography;

interface Props {
  denomination: string;
  amount: number;
  data_testid: string;
}

export const ContentLine_Two: FC<Props> = ({ denomination, amount, data_testid }) => {
  return (
    <Space size={60} data-testid={'columnLine'} className={s.columnLine}>
      <Text data-testid={['denomination', data_testid]}>{denomination}</Text>
      <Text data-testid={['amount', data_testid]}>
        {amount ? amount.toFixed(2) : Number(0).toFixed(2)}{' '}
      </Text>
    </Space>
  );
};
