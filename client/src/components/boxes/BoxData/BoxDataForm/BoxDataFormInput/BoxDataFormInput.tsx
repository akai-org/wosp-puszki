import type { FormProps } from 'antd';
import { FC } from 'react';
import { Space, Typography, InputNumber } from 'antd';
import s from './BoxDataFormInput.module.less';
const { Text } = Typography;

interface Props extends FormProps {
  value: number;
  quantity: number;
  count: (id: string, value: number) => void;
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
          precision={undefined}
          max={10000}
          value={quantity == 0 ? '' : quantity}
          className={[s.inputNumber, foreign ? s.foreign : ''].join(' ')}
          onChange={(val) => {
            val != null ? count(id, val as number) : count(id, 0);
          }}
        />
        {!foreign && <Text className={s.value}>{value} zł</Text>}
      </Space>
    </>
  );
};
