import { Typography, Space } from 'antd';
import s from './Main.module.css';
import { COLLECTED_ESKARBONKA_ID, COLLECTED_TOTAL_ID } from '@tests/utils/testIDs';
import { FC } from 'react';
const { Title } = Typography;

interface Collected {
  piggy: number;
  total: number;
}

export const Collected: FC<Collected> = ({ piggy, total }) => {
  return (
    <Space direction="vertical" size={40} className={s.collected}>
      <Space direction="vertical" size={10} align="center">
        <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
          Zebraliśmy z puszek
        </Title>
        <Title
          data-testid={COLLECTED_TOTAL_ID}
          level={2}
          style={{ margin: 0, fontWeight: 400 }}
        >
          {total} zł
        </Title>
      </Space>

      <Space direction="vertical" size={10} align="center">
        <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
          Zebraliśmy w eSkarbonce:
        </Title>
        <Title
          data-testid={COLLECTED_ESKARBONKA_ID}
          level={2}
          style={{ margin: 0, fontWeight: 400 }}
        >
          {piggy} zł
        </Title>
      </Space>
    </Space>
  );
};
