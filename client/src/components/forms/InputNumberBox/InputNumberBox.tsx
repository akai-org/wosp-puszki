import type { FormProps } from 'antd';
import { FC } from 'react';
import { Space, Typography, InputNumber } from 'antd';
import s from './InputNumberBox.module.less';
const { Text } = Typography;

interface Props extends FormProps {
  denomination: string;
  value: number;
  count: (den: string, val: any) => void;
  id: string;
}

export const InputNumberBox: FC<Props> = ({ denomination, value, count, id }) => {
  return (
    <>
      <Space className={s.container} size={50}>
        <Text>{denomination}</Text>
        <InputNumber
          addonBefore="+"
          placeholder="0"
          type="number"
          id={id}
          className={s.inputNumber}
          onChange={(val) => {
            count(id, val);
          }}
        />
        <Text>{value} zł</Text>
      </Space>
    </>
  );
};
