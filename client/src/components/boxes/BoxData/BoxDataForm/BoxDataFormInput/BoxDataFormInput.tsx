import type { FormProps } from 'antd';
import { FC } from 'react';
import { Space, Typography, InputNumber } from 'antd';
import s from './BoxDataFormInput.module.less';
const { Text } = Typography;

interface Props extends FormProps {
  value: number | null;
  quantity: number | null;
  count: (id: string, value: number | string) => void;
  id: string;
  name: string;
  foreign: boolean;
}

export const InputNumberBox: FC<Props> = ({
  value,
  count,
  id,
  quantity,
  name,
  foreign,
}) => {
  return (
    <Space className={s.container} size={40}>
      <Text className={s.denomination}>{name}</Text>
      <InputNumber
        size="small"
        type="number"
        name={name}
        id={id}
        required
        placeholder="0"
        min={0}
        precision={foreign ? 2 : 0}
        max={10000}
        value={quantity}
        className={[s.inputNumber, foreign ? s.foreign : ''].join(' ')}
        onBlur={(value) => {
          const val = value.target.value;
          if (!val) return;
          if (foreign) return count(id, parseFloat(val));
          val != null ? count(id, parseInt(val)) : count(id, 0);
        }}
      />
      {!foreign && <Text className={s.value}>{value} zł</Text>}
    </Space>
  );
};
