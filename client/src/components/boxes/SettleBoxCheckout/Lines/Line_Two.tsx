import { Space, Typography } from 'antd';
import { FC } from 'react';
import s from './Line.module.less';
const { Text } = Typography;

interface Props {
  denomination: string;
  amount: number;
  key: string;
}

export const ContentLine_Two: FC<Props> = ({ denomination, amount, key }) => {
  return (
    <Space size={60} key={key} className={s.columnLine}>
      <Text>{denomination}</Text>
      <Text>{amount}</Text>
    </Space>
  );
};
