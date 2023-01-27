import type { FC, ReactNode } from 'react';
import type { FormProps } from 'antd';
import { Space, Typography } from 'antd';
import s from './DepositFormColumn.module.less';
const { Text } = Typography;

interface Props extends FormProps {
  children: ReactNode;
}

export const DepositColumn: FC<Props> = ({ children }) => {
  return (
    <Space direction="vertical" className={s.container}>
      <Space size={80} className={s.columnNames}>
        <Text>Nominał</Text>
        <Text>Ilość</Text>
        <Text>Wartość</Text>
      </Space>

      {children}
    </Space>
  );
};
