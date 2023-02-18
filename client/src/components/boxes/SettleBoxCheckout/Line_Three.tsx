import { Space, Typography } from 'antd';
import { FC } from 'react';
import s from './Line.module.less';
const { Text } = Typography;

interface Props {
  denomination: string;
  amount: number;
  value: number;
  key: string;
}

export const ContentLine_Three: FC<Props> = ({ denomination, amount, value, key }) => {
  return (
    <Space size={60} key={key} className={s.columnLine}>
      <Text className={s.denomination}>{denomination}</Text>
      <Text className={s.amount}>{amount}</Text>
      <Text className={s.value}>{value} zł</Text>
    </Space>
  );
};
