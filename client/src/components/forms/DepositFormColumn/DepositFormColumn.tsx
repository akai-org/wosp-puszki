import type { FC, ReactNode } from 'react';
import type { FormProps } from 'antd';
import { Space, Typography } from 'antd';
import s from './DepositFormColumn.module.less';
const { Text } = Typography;

interface Props extends FormProps {
  children: ReactNode;
  foreign?: boolean;
}

export const DepositColumn: FC<Props> = ({ children, foreign }) => {
  return (
    <Space direction="vertical" className={s.container}>
      <Space size={60} className={s.columnNames}>
        <Text>{foreign ? 'Waluta' : 'Nominał'}</Text>
        {!foreign && <Text>Ilość</Text>}
        <Text>Wartość</Text>
      </Space>

      {children}
    </Space>
  );
};
