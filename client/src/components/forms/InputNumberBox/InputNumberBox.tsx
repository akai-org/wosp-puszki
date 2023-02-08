import type { FormProps } from 'antd';
import { FC } from 'react';
import { Space, Typography, InputNumber } from 'antd';
import s from './InputNumberBox.module.less';
const { Text } = Typography;

interface Props extends FormProps {
  value: number;
  df: number;
  count: (id: string, value: number) => void;
  id: string;
  name: string;
}

export const InputNumberBox: FC<Props> = ({ value, count, id, df, name }) => {
  return (
    <>
      <Space className={s.container} size={40}>
        <Text className={s.denomination}>{name}</Text>
        <InputNumber
          placeholder="0"
          size="small"
          type="number"
          name={name}
          id={id}
          min={0}
          max={10000}
          value={df}
          className={s.inputNumber}
          onChange={(val) => count(id, val as number)}
        />
        <Text className={s.value}>{value} zł</Text>
      </Space>
    </>
  );
};
