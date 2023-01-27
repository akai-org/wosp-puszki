import type { FormProps } from 'antd';
import { ReactNode, FC } from 'react';
import { Space, Typography, InputNumber } from 'antd';
import s from './InputNumberBox.module.less';
const { Text } = Typography;

interface Props extends FormProps {
  denomination: string;
  value: number;
}

export const InputNumberBox: FC<Props> = ({ denomination, value }) => {
  return (
    <>
      <Space className={s.container}>
        <Text>{denomination}</Text>
        <InputNumber
          addonBefore="+"
          placeholder="0"
          type="number"
          className={s.inputNumber}
        />
        <Text>{value} zł</Text>
      </Space>
    </>
  );
};
