import type { FormProps } from 'antd';
import { FC } from 'react';
import { Space, Typography, InputNumber } from 'antd';
import s from './InputNumberBox.module.less';
const { Text } = Typography;

interface Props extends FormProps {
  denomination: string;
  value: number;
  df: number;
  count: (den: string, val: any) => void;
  id: string;
}

export const InputNumberBox: FC<Props> = ({ denomination, value, count, id, df }) => {
  return (
    <>
      <Space className={s.container} size={40}>
        <Text className={s.denomination}>{denomination}</Text>
        <InputNumber
          placeholder="0"
          size="small"
          type="number"
          id={id}
          min={0}
          max={10000}
          value={df}
          className={s.inputNumber}
          onChange={(val) => {
            count(id, val);
          }}
        />
        <Text className={s.value}>{value} zł</Text>
      </Space>
    </>
  );
};
