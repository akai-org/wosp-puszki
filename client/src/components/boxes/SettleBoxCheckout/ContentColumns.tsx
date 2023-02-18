import {
  BoxData,
  FOREIGN_AMOUNTS_KEYS,
  MONEY_AMOUNTS_VALUES,
  MONEY_VALUES,
  ZLOTY_AMOUNTS_KEYS,
  moneyValuesType,
} from '@/utils';
import { Space, Typography } from 'antd';
import { FC } from 'react';
import s from './ContentColumns.module.less';
import { ContentLine_Three } from './Line_Three';
import { ContentLine_Two } from './Line_Two';

const { Text, Title } = Typography;

interface Props {
  boxData: BoxData;
  total: number;
}

export const ContentColumns: FC<Props> = ({ boxData, total }) => {
  return (
    <Space className={s.contentColumns}>
      <Space className={s.contentColumn} direction="vertical">
        <Space size={60} className={s.columnNames}>
          <p>Nominał</p>
          <p>Ilość</p>
          <p>Wartość</p>
        </Space>
        {ZLOTY_AMOUNTS_KEYS.map((key) => (
          <ContentLine_Three
            denomination={MONEY_AMOUNTS_VALUES[key]}
            amount={boxData.amounts[key]}
            value={
              boxData.amounts[key] *
              MONEY_VALUES[MONEY_AMOUNTS_VALUES[key] as keyof moneyValuesType]
            }
            key={key}
          />
        ))}
        <Space className={s.columnBottom}>
          <Text>Suma (PLN)</Text>
          <Text>{total} zł</Text>
        </Space>
      </Space>
      <Space className={s.contentColumn} direction="vertical">
        <Space size={60} className={s.columnNames}>
          <p>Nominał</p>
          <p>Ilość</p>
        </Space>
        {FOREIGN_AMOUNTS_KEYS.map((key) => (
          <ContentLine_Two
            denomination={MONEY_AMOUNTS_VALUES[key]}
            amount={boxData.amounts[key]}
            key={key}
          />
        ))}
        <Space className={s.columnBottom}>
          <Text>Inne</Text>
          <Text>{boxData.comment}</Text>
        </Space>
      </Space>
      <Space className={s.sum}>
        <Title level={4}>Suma (bez walut obcych):</Title>
        <Title level={4}>{total} zł</Title>
      </Space>
    </Space>
  );
};
